<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EntityComparison;
use App\Models\EntityType;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class EntityComparisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EntityComparison::with(['entityType', 'comparedEntityType', 'state', 'country']);

        // Filter by entity type
        if ($request->filled('entity_type_id')) {
            $query->where(function ($q) use ($request) {
                $q->where('entity_type_id', $request->entity_type_id)
                    ->orWhere('compared_entity_type_id', $request->entity_type_id);
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortField = $request->get('sort', 'sort_order');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $comparisons = $query->paginate(15)->withQueryString();

        $entityTypes = EntityType::where('status', true)->orderBy('name')->get();

        return view('admin.entity-comparisons.index', compact('comparisons', 'entityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entityTypes = EntityType::where('status', true)->orderBy('name')->get();
        $states = State::where('status', true)->orderBy('name')->get();
        $countries = Country::where('status', true)->orderBy('name')->get();
        $categories = $this->getCategories();

        return view('admin.entity-comparisons.create', compact('entityTypes', 'states', 'countries', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'entity_type_id' => 'required|exists:entity_types,id',
            'compared_entity_type_id' => 'required|exists:entity_types,id|different:entity_type_id',
            'state_id' => 'nullable|exists:states,id',
            'country_id' => 'nullable|exists:countries,id',
            'category' => 'nullable|string|max:100',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'notes' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'status' => 'boolean',
        ]);

        EntityComparison::create($validated);

        return redirect()->route('admin.entity-comparisons.index')
            ->with('success', 'Entity comparison created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EntityComparison $entityComparison)
    {
        $entityComparison->load(['entityType', 'comparedEntityType', 'state', 'country']);
        return view('admin.entity-comparisons.show', compact('entityComparison'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntityComparison $entityComparison)
    {
        $entityTypes = EntityType::where('status', true)->orderBy('name')->get();
        $states = State::where('status', true)->orderBy('name')->get();
        $countries = Country::where('status', true)->orderBy('name')->get();
        $categories = $this->getCategories();

        return view('admin.entity-comparisons.edit', compact('entityComparison', 'entityTypes', 'states', 'countries', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntityComparison $entityComparison)
    {
        $validated = $request->validate([
            'entity_type_id' => 'required|exists:entity_types,id',
            'compared_entity_type_id' => 'required|exists:entity_types,id|different:entity_type_id',
            'state_id' => 'nullable|exists:states,id',
            'country_id' => 'nullable|exists:countries,id',
            'category' => 'nullable|string|max:100',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'notes' => 'nullable|string',
            'sort_order' => 'integer|min:0',
            'status' => 'boolean',
        ]);

        $entityComparison->update($validated);

        return redirect()->route('admin.entity-comparisons.index')
            ->with('success', 'Entity comparison updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntityComparison $entityComparison)
    {
        $entityComparison->delete();

        return redirect()->route('admin.entity-comparisons.index')
            ->with('success', 'Entity comparison deleted successfully.');
    }

    /**
     * Bulk actions (delete, activate, deactivate).
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'ids' => 'required|array',
            'ids.*' => 'exists:entity_comparisons,id',
        ]);

        $count = count($request->ids);

        match ($request->action) {
            'delete' => EntityComparison::whereIn('id', $request->ids)->delete(),
            'activate' => EntityComparison::whereIn('id', $request->ids)->update(['status' => 1]),
            'deactivate' => EntityComparison::whereIn('id', $request->ids)->update(['status' => 0]),
        };

        $message = match ($request->action) {
            'delete' => "{$count} comparison(s) deleted successfully.",
            'activate' => "{$count} comparison(s) activated successfully.",
            'deactivate' => "{$count} comparison(s) deactivated successfully.",
        };

        return redirect()->route('admin.entity-comparisons.index')
            ->with('success', $message);
    }

    /**
     * Get available comparison categories.
     */
    private function getCategories(): array
    {
        return [
            'overview' => 'Overview',
            'taxation' => 'Taxation',
            'liability' => 'Liability Protection',
            'formation' => 'Formation Requirements',
            'compliance' => 'Compliance',
            'ownership' => 'Ownership Structure',
            'management' => 'Management',
            'cost' => 'Cost Comparison',
            'fundraising' => 'Fundraising',
            'custom' => 'Custom Category',
        ];
    }
}