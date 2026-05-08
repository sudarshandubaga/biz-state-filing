@if (!isset($admin_user))
    @php $admin_user = null; @endphp
@endif

<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span
                    class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $admin_user?->name) }}" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror"
                placeholder="Full name">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                    class="text-red-500">*</span></label>
            <input type="email" name="email" id="email" value="{{ old('email', $admin_user?->email) }}" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                placeholder="email@example.com">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="login_name" class="block text-sm font-medium text-gray-700 mb-1">Login Name <span
                    class="text-red-500">*</span></label>
            <input type="text" name="login_name" id="login_name"
                value="{{ old('login_name', $admin_user?->login_name) }}" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('login_name') border-red-500 @enderror"
                placeholder="Username for login">
            @error('login_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role <span
                    class="text-red-500">*</span></label>
            <select name="role" id="role" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('role') border-red-500 @enderror">
                <option value="admin" {{ old('role', $admin_user?->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role', $admin_user?->role) == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Password @if (!$admin_user)
                    <span class="text-red-500">*</span>
                @endif
            </label>
            <input type="password" name="password" id="password" {{ $admin_user ? '' : 'required' }}
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-500 @enderror"
                placeholder="{{ $admin_user ? 'Leave empty to keep current' : 'Min 8 characters' }}">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="Confirm password">
        </div>
    </div>

    @if ($admin_user)
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('status') border-red-500 @enderror">
                <option value="1" {{ old('status', $admin_user?->status) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $admin_user?->status) === 0 ? 'selected' : '' }}>Inactive
                </option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    @endif
</div>
