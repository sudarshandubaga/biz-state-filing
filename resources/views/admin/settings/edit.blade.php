@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- General Settings -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">General Settings</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Site Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="site_name" id="site_name"
                                value="{{ old('site_name', $setting->site_name) }}" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('site_name') border-red-500 @enderror">
                            @error('site_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-1">Admin
                                Email</label>
                            <input type="email" name="admin_email" id="admin_email"
                                value="{{ old('admin_email', $setting->admin_email) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('admin_email') border-red-500 @enderror"
                                placeholder="admin@example.com">
                            @error('admin_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Logo & Favicon -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Logo & Favicon</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Logo (200px width, auto-converted to
                                WebP)</label>
                            @if ($setting->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/settings/' . $setting->logo) }}" alt="Logo"
                                        class="h-12">
                                </div>
                            @endif
                            <input type="file" name="logo" id="logo" accept="image/*"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('logo') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Max 2MB. Will be resized to 200px width and converted to
                                WebP.</p>
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Favicon (32x32, auto-converted to
                                WebP)</label>
                            @if ($setting->favicon)
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/settings/' . $setting->favicon) }}" alt="Favicon"
                                        class="h-8 w-8">
                                </div>
                            @endif
                            <input type="file" name="favicon" id="favicon" accept="image/*"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('favicon') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Max 1MB. Will be resized to 32x32 and converted to WebP.
                            </p>
                            @error('favicon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Details -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Contact Details</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Contact
                                Email</label>
                            <input type="email" name="contact_email" id="contact_email"
                                value="{{ old('contact_email', $setting->contact_email) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('contact_email') border-red-500 @enderror"
                                placeholder="contact@example.com">
                            @error('contact_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Contact
                                Phone</label>
                            <input type="text" name="contact_phone" id="contact_phone"
                                value="{{ old('contact_phone', $setting->contact_phone) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('contact_phone') border-red-500 @enderror"
                                placeholder="+1 (555) 123-4567">
                            @error('contact_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="contact_address" class="block text-sm font-medium text-gray-700 mb-1">Contact
                            Address</label>
                        <textarea name="contact_address" id="contact_address" rows="2"
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('contact_address') border-red-500 @enderror"
                            placeholder="123 Business Street, Suite 100, City, State, ZIP">{{ old('contact_address', $setting->contact_address) }}</textarea>
                        @error('contact_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Social Links -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Social Links</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-1">Facebook
                                URL</label>
                            <input type="url" name="facebook_url" id="facebook_url"
                                value="{{ old('facebook_url', $setting->facebook_url) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('facebook_url') border-red-500 @enderror"
                                placeholder="https://facebook.com/yourpage">
                            @error('facebook_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-1">Instagram
                                URL</label>
                            <input type="url" name="instagram_url" id="instagram_url"
                                value="{{ old('instagram_url', $setting->instagram_url) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('instagram_url') border-red-500 @enderror"
                                placeholder="https://instagram.com/yourprofile">
                            @error('instagram_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-1">Twitter / X
                                URL</label>
                            <input type="url" name="twitter_url" id="twitter_url"
                                value="{{ old('twitter_url', $setting->twitter_url) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('twitter_url') border-red-500 @enderror"
                                placeholder="https://x.com/yourhandle">
                            @error('twitter_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="pinterest_url" class="block text-sm font-medium text-gray-700 mb-1">Pinterest
                                URL</label>
                            <input type="url" name="pinterest_url" id="pinterest_url"
                                value="{{ old('pinterest_url', $setting->pinterest_url) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('pinterest_url') border-red-500 @enderror"
                                placeholder="https://pinterest.com/yourprofile">
                            @error('pinterest_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn
                                URL</label>
                            <input type="url" name="linkedin_url" id="linkedin_url"
                                value="{{ old('linkedin_url', $setting->linkedin_url) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('linkedin_url') border-red-500 @enderror"
                                placeholder="https://linkedin.com/company/yourcompany">
                            @error('linkedin_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-1">YouTube
                                URL</label>
                            <input type="url" name="youtube_url" id="youtube_url"
                                value="{{ old('youtube_url', $setting->youtube_url) }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('youtube_url') border-red-500 @enderror"
                                placeholder="https://youtube.com/@yourchannel">
                            @error('youtube_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Custom Scripts -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Custom Scripts</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="header_scripts" class="block text-sm font-medium text-gray-700 mb-1">Header
                                Scripts (CSS/JS inserted before </head>)</label>
                            <textarea name="header_scripts" id="header_scripts" rows="6"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono @error('header_scripts') border-red-500 @enderror"
                                placeholder="<style> ... </style>&#10;<script>
                                    ...
                                </script>">{{ old('header_scripts', $setting->header_scripts) }}</textarea>
                            @error('header_scripts')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="footer_scripts" class="block text-sm font-medium text-gray-700 mb-1">Footer
                                Scripts (CSS/JS inserted before </body>)</label>
                            <textarea name="footer_scripts" id="footer_scripts" rows="6"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono @error('footer_scripts') border-red-500 @enderror"
                                placeholder="<script>
                                    ...
                                </script>">{{ old('footer_scripts', $setting->footer_scripts) }}</textarea>
                            @error('footer_scripts')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-3 pt-4 border-t">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save Settings
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
