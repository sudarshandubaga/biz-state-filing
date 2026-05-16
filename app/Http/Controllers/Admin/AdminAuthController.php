<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AdminAuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle login attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login_name' => ['required', 'string'],
            'password' => ['required'],
            'captcha' => ['required', 'string'],
        ]);

        // Validate CAPTCHA
        $captchaCode = session('captcha_code');
        if (empty($captchaCode) || strtoupper($request->captcha) !== $captchaCode) {
            return back()->withErrors([
                'captcha' => 'The security code you entered is incorrect.',
            ])->onlyInput('login_name');
        }

        $credentials = [
            'login_name' => $request->login_name,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            // Clear CAPTCHA code after successful login
            session()->forget('captcha_code');
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'login_name' => 'The provided credentials do not match our records.',
        ])->onlyInput('login_name');
    }

    /**
     * Show the forgot password form.
     */
    public function showForgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Handle forgot password request.
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show the reset password form.
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('admin.auth.reset-password', [
            'email' => $request->email,
            'token' => $token,
        ]);
    }

    /**
     * Handle reset password request.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Admin $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Show the dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the change password form.
     */
    public function showChangePassword()
    {
        return view('admin.auth.change-password');
    }

    /**
     * Handle change password request.
     */
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed', 'different:current_password'],
        ]);

        $request->user()->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        return back()->with('status', 'Password updated successfully.');
    }

    /**
     * Show the edit profile form.
     */
    public function showEditProfile()
    {
        return view('admin.auth.edit-profile');
    }

    /**
     * Handle update profile request.
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email,' . $user->id],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                $oldPhotoPath = public_path('uploads/admins/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->extension();
            $photo->move(public_path('uploads/admins'), $photoName);
            $validated['photo'] = $photoName;
        }

        $user->update($validated);

        return back()->with('status', 'Profile updated successfully.');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
