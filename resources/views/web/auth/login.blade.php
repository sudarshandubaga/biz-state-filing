@extends('web.layouts.app')
@section('title', 'Log In')
@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 text-center mb-2">Welcome Back</h2>
                    <p class="text-gray-600 text-center mb-6">Log in to continue your business filing.</p>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="space-y-4">
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
                                <input type="password" name="password" required
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember"
                                    class="h-4 w-4 text-blue-600 rounded mr-2">
                                <label for="remember" class="text-gray-600 text-sm">Remember me</label>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors mt-6">Log
                            In</button>
                    </form>
                    <p class="text-center text-gray-500 text-sm mt-4">Don't have an account? <a
                            href="{{ route('auth.register') }}" class="text-blue-600 hover:underline">Create one</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
