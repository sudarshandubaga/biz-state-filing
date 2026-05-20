@extends('web.layouts.app')

@section('title', 'Contact Us - BizStateFiling')
@section('meta_description',
    'Get in touch with us for any questions about business state filing, entity types, and
    compliance requirements.')
@section('meta_keywords', 'contact us, business filing help, support, customer service')

@section('page_title', 'Contact Us')

@section('page_subtitle', 'Have a question or need assistance? We\'d love to hear from you.')

@section('content')

    <!-- Contact Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <!-- Contact Form -->
                <div>
                    <h2 class="text-2xl font-bold mb-6">Send Us a Message</h2>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('web.contact.send') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror"
                                placeholder="Your full name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                                placeholder="your@email.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('phone') border-red-500 @enderror"
                                placeholder="Your phone number (optional)">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject <span
                                    class="text-red-500">*</span></label>
                            <select name="subject" id="subject" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('subject') border-red-500 @enderror">
                                <option value="">Select a subject</option>
                                <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>
                                    General Inquiry</option>
                                <option value="Business Filing Help"
                                    {{ old('subject') == 'Business Filing Help' ? 'selected' : '' }}>Business Filing Help
                                </option>
                                <option value="Technical Support"
                                    {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support
                                </option>
                                <option value="Billing Question"
                                    {{ old('subject') == 'Billing Question' ? 'selected' : '' }}>Billing Question</option>
                                <option value="Partnership Inquiry"
                                    {{ old('subject') == 'Partnership Inquiry' ? 'selected' : '' }}>Partnership Inquiry
                                </option>
                                <option value="Feedback" {{ old('subject') == 'Feedback' ? 'selected' : '' }}>Feedback
                                </option>
                                <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message <span
                                    class="text-red-500">*</span></label>
                            <textarea name="message" id="message" rows="6" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('message') border-red-500 @enderror"
                                placeholder="How can we help you?">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CAPTCHA -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <label class="block text-sm font-medium text-gray-700">Security Check <span
                                        class="text-red-500">*</span></label>
                                <button type="button" id="refreshCaptcha"
                                    class="text-sm text-blue-600 hover:text-blue-800 flex items-center"
                                    title="Refresh CAPTCHA">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Refresh
                                </button>
                            </div>
                            <div class="mb-3">
                                <img id="captchaImage" src="{{ route('captcha.image') }}" alt="CAPTCHA verification code"
                                    class="border border-gray-300 rounded-lg w-full"
                                    style="height: 50px; object-fit: contain; background: #fff;">
                            </div>
                            <div>
                                <input type="text" name="captcha" id="captcha" value="{{ old('captcha') }}" required
                                    class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('captcha') border-red-500 @enderror"
                                    placeholder="Enter the code shown above" autocomplete="off">
                            </div>
                            @error('captcha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full px-6 py-3 bg-blue-600 text-white rounded-md text-base font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-bold mb-6">Get In Touch</h2>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                                <p class="text-gray-600 mt-1">
                                    <a href="mailto:admin@bizstatefiling.com"
                                        class="text-blue-600 hover:text-blue-800">admin@bizstatefiling.com</a>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Business Hours</h3>
                                <p class="text-gray-600 mt-1">Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p class="text-gray-600">Saturday: 10:00 AM - 2:00 PM</p>
                                <p class="text-gray-600">Sunday: Closed</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Help Center</h3>
                                <p class="text-gray-600 mt-1">Visit our <a href="{{ route('web.page', 'help-center') }}"
                                        class="text-blue-600 hover:text-blue-800">Help Center</a> for answers to frequently
                                    asked questions.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // alert("Hi")
            const refreshBtn = document.getElementById('refreshCaptcha');
            const captchaImage = document.getElementById('captchaImage');
            const captchaInput = document.getElementById('captcha');
            console.log('refresh btn: ', refreshBtn);

            if (refreshBtn) {
                refreshBtn.addEventListener('click', function() {
                    // alert();
                    // Simply reload the captcha image - each call generates a new code
                    captchaImage.src = '{{ route('captcha.image') }}?' + Date.now();
                    if (captchaInput) captchaInput.value = '';
                });
            }
        });
    </script>
@endpush
