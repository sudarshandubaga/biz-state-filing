<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EntityType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EntityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EntityType::query();

        // Filter by search term
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort
        $sortField = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $entityTypes = $query->paginate(15)->withQueryString();

        return view('admin.entity-types.index', compact('entityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.entity-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:entity_types,slug',
            'icon' => 'nullable|string|max:50',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'status' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        EntityType::create($validated);

        return redirect()->route('admin.entity-types.index')
            ->with('success', 'Entity type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EntityType $entityType)
    {
        return view('admin.entity-types.show', compact('entityType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntityType $entityType)
    {
        return view('admin.entity-types.edit', compact('entityType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntityType $entityType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:entity_types,slug,' . $entityType->id,
            'icon' => 'nullable|string|max:50',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'status' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $entityType->update($validated);

        return redirect()->route('admin.entity-types.index')
            ->with('success', 'Entity type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntityType $entityType)
    {
        $entityType->delete();

        return redirect()->route('admin.entity-types.index')
            ->with('success', 'Entity type deleted successfully.');
    }

    /**
     * Bulk actions (delete, activate, deactivate).
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'ids' => 'required|array',
            'ids.*' => 'exists:entity_types,id',
        ]);

        $count = count($request->ids);

        match ($request->action) {
            'delete' => EntityType::whereIn('id', $request->ids)->delete(),
            'activate' => EntityType::whereIn('id', $request->ids)->update(['status' => 1]),
            'deactivate' => EntityType::whereIn('id', $request->ids)->update(['status' => 0]),
        };

        $message = match ($request->action) {
            'delete' => "{$count} entity type(s) deleted successfully.",
            'activate' => "{$count} entity type(s) activated successfully.",
            'deactivate' => "{$count} entity type(s) deactivated successfully.",
        };

        return redirect()->route('admin.entity-types.index')
            ->with('success', $message);
    }
}
