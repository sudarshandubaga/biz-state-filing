<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Screen 1: Show registration form
    public function showRegister()
    {
        return view('web.auth.register');
    }

    // Screen 1: Process registration
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:bsf_users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'verification_code_sent_at' => now(),
        ]);

        // Merge any existing formation session data into the new user
        // (user was browsing before registering)
        Auth::login($user);

        // Send verification email
        $this->sendVerificationEmail($user);

        return redirect()->route('auth.verify')
            ->with('success', 'Account created! Please verify your email.');
    }

    // Screen 2: Show verify email form
    public function showVerify()
    {
        return view('web.auth.verify');
    }

    // Screen 2: Process verification
    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|string|size:6']);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'Please log in first.');
        }

        // Check if code matches and hasn't expired (10 min)
        if ($user->verification_code !== $request->code) {
            return back()->with('error', 'Invalid verification code.');
        }

        if ($user->verification_code_sent_at && $user->verification_code_sent_at->addMinutes(10)->isPast()) {
            return back()->with('error', 'Verification code expired. Request a new one.');
        }

        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'verification_code_sent_at' => null,
        ]);

        // After verification, push into the formation flow
        if (session()->has('formation.redirect_to')) {
            return redirect(session('formation.redirect_to'))
                ->with('success', 'Email verified! Continue with your business formation.');
        }

        return redirect()->route('formation.start')
            ->with('success', 'Email verified! Start your business formation now.');
    }

    // Resend verification code
    public function resendCode()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'Please log in first.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('formation.start')->with('info', 'Email already verified.');
        }

        $user->update([
            'verification_code' => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'verification_code_sent_at' => now(),
        ]);

        $this->sendVerificationEmail($user);

        return back()->with('success', 'New verification code sent to your email.');
    }

    // Show login form
    public function showLogin()
    {
        return view('web.auth.login');
    }

    // Process login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->update(['last_login_at' => now()]);

            // Check if email is verified
            if (!$user->email_verified_at) {
                return redirect()->route('auth.verify')
                    ->with('warning', 'Please verify your email address.');
            }

            // Redirect to formation if they were in the middle
            if (session()->has('formation.redirect_to')) {
                return redirect(session('formation.redirect_to'));
            }

            return redirect()->route('formation.start');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    // Send verification email
    private function sendVerificationEmail(User $user)
    {
        try {
            Mail::raw(
                "Hi {$user->full_name},\n\nYour verification code is: {$user->verification_code}\n\nThis code expires in 10 minutes.\n\nThank you,\nBizStateFiling Team",
                function ($message) use ($user) {
                    $message->to($user->email, $user->full_name)
                        ->subject('Verify Your Email - BizStateFiling')
                        ->from(config('mail.from.address'), config('mail.from.name'));
                }
            );
        } catch (\Exception $e) {
            // Log error but don't break the flow
            \Illuminate\Support\Facades\Log::error('Failed to send verification email: ' . $e->getMessage());
        }
    }
}
