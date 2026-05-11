@extends('web.layouts.app')
@section('title', 'Create Account')
@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 text-center mb-2">Create Your Account</h2>
                    <p class="text-gray-600 text-center mb-6">Register to start your business formation.</p>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('auth.register') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 @error('full_name') border-red-500 @enderror">
                                @error('full_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Password</label>
                                <input type="password" name="password" required minlength="8"
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" required minlength="8"
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors mt-6">Create
                            Account</button>
                    </form>
                    <p class="text-center text-gray-500 text-sm mt-4">Already have an account? <a
                            href="{{ route('auth.login') }}" class="text-blue-600 hover:underline">Log in</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
