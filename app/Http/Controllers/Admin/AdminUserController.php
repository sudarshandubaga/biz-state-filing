<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Admin::query();

        // Filter by search term
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('login_name', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort
        $sortField = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $admins = $query->paginate(15)->withQueryString();

        return view('admin.admin-users.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email',
            'login_name' => 'required|string|max:255|unique:admins,login_name',
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
            'role' => 'required|in:admin,staff',
            'status' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return redirect()->route('admin.admin-users.index')
            ->with('success', 'Admin user created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin_user)
    {
        return view('admin.admin-users.show', compact('admin_user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin_user)
    {
        return view('admin.admin-users.edit', compact('admin_user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin_user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin_user->id,
            'login_name' => 'required|string|max:255|unique:admins,login_name,' . $admin_user->id,
            'password' => ['nullable', 'confirmed', PasswordRule::min(8)],
            'role' => 'required|in:admin,staff',
            'status' => 'boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin_user->update($validated);

        return redirect()->route('admin.admin-users.index')
            ->with('success', 'Admin user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin_user)
    {
        // Prevent deleting yourself
        if ($admin_user->id === auth('admin')->id()) {
            return redirect()->route('admin.admin-users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $admin_user->delete();

        return redirect()->route('admin.admin-users.index')
            ->with('success', 'Admin user deleted successfully.');
    }

    /**
     * Bulk actions (delete, activate, deactivate).
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'ids' => 'required|array',
            'ids.*' => 'exists:admins,id',
        ]);

        $count = count($request->ids);

        // Prevent bulk deleting self
        if ($request->action === 'delete' && in_array(auth('admin')->id(), $request->ids)) {
            return redirect()->route('admin.admin-users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        match ($request->action) {
            'delete' => Admin::whereIn('id', $request->ids)->delete(),
            'activate' => Admin::whereIn('id', $request->ids)->update(['status' => 1]),
            'deactivate' => Admin::whereIn('id', $request->ids)->update(['status' => 0]),
        };

        $message = match ($request->action) {
            'delete' => "{$count} admin user(s) deleted successfully.",
            'activate' => "{$count} admin user(s) activated successfully.",
            'deactivate' => "{$count} admin user(s) deactivated successfully.",
        };

        return redirect()->route('admin.admin-users.index')
            ->with('success', $message);
    }
}