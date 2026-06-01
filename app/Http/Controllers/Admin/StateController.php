<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = State::with('country');

        // Filter by search term
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('state_name', 'like', "%{$search}%")
                    ->orWhere('state_slug', 'like', "%{$search}%")
                    ->orWhere('filing_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by deadline type
        if ($request->filled('deadline_type')) {
            $query->where('deadline_type', $request->deadline_type);
        }

        // Filter by country
        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        // Sort
        $sortField = $request->get('sort', 'state_name');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $states = $query->paginate(15)->withQueryString();
        $countries = Country::all();

        return view('admin.states.index', compact('states', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.states.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_name' => 'required|string|max:100',
            'state_slug' => 'nullable|string|max:100|unique:states,state_slug',
            'filing_name' => 'nullable|string|max:150',
            'filing_fee' => 'nullable|numeric|min:0',
            'late_fee' => 'nullable|numeric|min:0',
            'deadline_type' => 'required|in:fixed,anniversary,varies',
            'deadline_month' => 'nullable|integer|min:1|max:12',
            'deadline_day' => 'nullable|integer|min:1|max:31',
            'renewal_cycle' => 'nullable|string|max:50',
            'report_required' => 'boolean',
            'compliance_agency' => 'nullable|string|max:255',
            'portal_url' => 'nullable|url|max:255',
            'affiliate_url' => 'nullable|url|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'status' => 'boolean',
            // New rich fields
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'standard_processing_days' => 'nullable|string|max:50',
            'standard_processing_label' => 'nullable|string|max:255',
            'expedited_processing_text' => 'nullable|string|max:100',
            'expedited_processing_label' => 'nullable|string|max:255',
            'annual_llc_fee' => 'nullable|numeric|min:0',
            'annual_llc_fee_label' => 'nullable|string|max:255',
            'cta_heading' => 'nullable|string|max:255',
            'cta_subheading' => 'nullable|string',
            'benefits_data' => 'nullable|json',
            'industry_sectors_data' => 'nullable|json',
            'execution_steps_data' => 'nullable|json',
            'faqs_data' => 'nullable|json',
            'ecosystem_heading' => 'nullable|string|max:255',
            'ecosystem_content' => 'nullable|string',
            'ecosystem_link_url' => 'nullable|url|max:255',
            'ecosystem_link_text' => 'nullable|string|max:255',
        ]);

        if (empty($validated['state_slug'])) {
            $validated['state_slug'] = Str::slug($validated['state_name']);
        }

        State::create($validated);

        return redirect()->route('admin.states.index')
            ->with('success', 'State created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        $state->load('country');
        return view('admin.states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $countries = Country::all();
        return view('admin.states.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_name' => 'required|string|max:100',
            'state_slug' => 'nullable|string|max:100|unique:states,state_slug,' . $state->id,
            'filing_name' => 'nullable|string|max:150',
            'filing_fee' => 'nullable|numeric|min:0',
            'late_fee' => 'nullable|numeric|min:0',
            'deadline_type' => 'required|in:fixed,anniversary,varies',
            'deadline_month' => 'nullable|integer|min:1|max:12',
            'deadline_day' => 'nullable|integer|min:1|max:31',
            'renewal_cycle' => 'nullable|string|max:50',
            'report_required' => 'boolean',
            'compliance_agency' => 'nullable|string|max:255',
            'portal_url' => 'nullable|url|max:255',
            'affiliate_url' => 'nullable|url|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'status' => 'boolean',
            // New rich fields
            'hero_heading' => 'nullable|string|max:255',
            'hero_subheading' => 'nullable|string',
            'standard_processing_days' => 'nullable|string|max:50',
            'standard_processing_label' => 'nullable|string|max:255',
            'expedited_processing_text' => 'nullable|string|max:100',
            'expedited_processing_label' => 'nullable|string|max:255',
            'annual_llc_fee' => 'nullable|numeric|min:0',
            'annual_llc_fee_label' => 'nullable|string|max:255',
            'cta_heading' => 'nullable|string|max:255',
            'cta_subheading' => 'nullable|string',
            'benefits_data' => 'nullable|json',
            'industry_sectors_data' => 'nullable|json',
            'execution_steps_data' => 'nullable|json',
            'faqs_data' => 'nullable|json',
            'ecosystem_heading' => 'nullable|string|max:255',
            'ecosystem_content' => 'nullable|string',
            'ecosystem_link_url' => 'nullable|url|max:255',
            'ecosystem_link_text' => 'nullable|string|max:255',
        ]);

        if (empty($validated['state_slug'])) {
            $validated['state_slug'] = Str::slug($validated['state_name']);
        }

        $state->update($validated);

        return redirect()->route('admin.states.index')
            ->with('success', 'State updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();

        return redirect()->route('admin.states.index')
            ->with('success', 'State deleted successfully.');
    }

    /**
     * Bulk actions (delete, activate, deactivate).
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'ids' => 'required|array',
            'ids.*' => 'exists:states,id',
        ]);

        $count = count($request->ids);

        match ($request->action) {
            'delete' => State::whereIn('id', $request->ids)->delete(),
            'activate' => State::whereIn('id', $request->ids)->update(['status' => 1]),
            'deactivate' => State::whereIn('id', $request->ids)->update(['status' => 0]),
        };

        $message = match ($request->action) {
            'delete' => "{$count} state(s) deleted successfully.",
            'activate' => "{$count} state(s) activated successfully.",
            'deactivate' => "{$count} state(s) deactivated successfully.",
        };

        return redirect()->route('admin.states.index')
            ->with('success', $message);
    }
}
