@extends('web.layouts.app')
@section('title', 'Verify Email')
@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 text-center mb-2">Verify Your Email</h2>
                    <p class="text-gray-600 text-center mb-6">We've sent a 6-digit verification code to
                        <strong>{{ auth()->user()->email ?? 'your email' }}</strong>. Please enter it below.</p>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}</div>
                    @endif
                    @if (session('warning'))
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                            {{ session('warning') }}</div>
                    @endif
                    <form method="POST" action="{{ route('auth.verify.post') }}">
                        @csrf
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 text-center">Verification Code</label>
                            <input type="text" name="code" maxlength="6" placeholder="000000"
                                class="w-full text-center text-2xl tracking-widest border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 @error('code') border-red-500 @enderror">
                            @error('code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors mt-6">Verify
                            Email</button>
                    </form>
                    <form method="POST" action="{{ route('auth.verify.resend') }}" class="mt-4 text-center">
                        @csrf
                        <p class="text-gray-500 text-sm">Didn't receive the code? <button type="submit"
                                class="text-blue-600 hover:underline bg-transparent border-none cursor-pointer">Resend
                                Code</button></p>
                    </form>
                    <p class="text-center text-gray-500 text-sm mt-2"><a href="{{ route('formation.start') }}"
                            class="text-gray-400 hover:underline">Skip for now & start filing →</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
