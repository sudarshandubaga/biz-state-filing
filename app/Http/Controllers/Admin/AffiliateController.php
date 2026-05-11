<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\State;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function index(Request $request)
    {
        $query = Affiliate::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        $sortField = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $affiliates = $query->paginate(15)->withQueryString();

        return view('admin.affiliates.index', compact('affiliates'));
    }

    public function create()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        $entityTypes = ['llc', 's-corporation', 'c-corporation', 'partnership', 'sole-proprietorship', 'professional-entity', 'foreign-qualification'];
        $services = ['registered-agent', 'ein', 'annual-report', 'operating-agreement', 'bylaws', 'partnership-agreement', 'dba', 'license', 's-corp-election'];

        return view('admin.affiliates.create', compact('states', 'entityTypes', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:bsf_affiliates,email',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'supported_states' => 'nullable|array',
            'supported_states.*' => 'exists:states,id',
            'supported_entity_types' => 'nullable|array',
            'services_offered' => 'nullable|array',
            'commission_priority' => 'nullable|integer|min:0',
            'max_load' => 'nullable|integer|min:1|max:1000',
            'webhook_url' => 'nullable|url|max:500',
            'api_key' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
            'is_available' => 'nullable|boolean',
        ]);

        $validated['supported_states'] = $request->supported_states ?? [];
        $validated['supported_entity_types'] = $request->supported_entity_types ?? [];
        $validated['services_offered'] = $request->services_offered ?? [];
        $validated['commission_priority'] = $validated['commission_priority'] ?? 0;
        $validated['max_load'] = $validated['max_load'] ?? 100;
        $validated['status'] = $request->boolean('status', true);
        $validated['is_available'] = $request->boolean('is_available', true);

        Affiliate::create($validated);

        return redirect()->route('admin.affiliates.index')
            ->with('success', 'Affiliate created successfully.');
    }

    public function show(Affiliate $affiliate)
    {
        $affiliate->load('leads');
        return view('admin.affiliates.show', compact('affiliate'));
    }

    public function edit(Affiliate $affiliate)
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        $entityTypes = ['llc', 's-corporation', 'c-corporation', 'partnership', 'sole-proprietorship', 'professional-entity', 'foreign-qualification'];
        $services = ['registered-agent', 'ein', 'annual-report', 'operating-agreement', 'bylaws', 'partnership-agreement', 'dba', 'license', 's-corp-election'];

        return view('admin.affiliates.edit', compact('affiliate', 'states', 'entityTypes', 'services'));
    }

    public function update(Request $request, Affiliate $affiliate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:bsf_affiliates,email,' . $affiliate->id,
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'supported_states' => 'nullable|array',
            'supported_states.*' => 'exists:states,id',
            'supported_entity_types' => 'nullable|array',
            'services_offered' => 'nullable|array',
            'commission_priority' => 'nullable|integer|min:0',
            'max_load' => 'nullable|integer|min:1|max:1000',
            'webhook_url' => 'nullable|url|max:500',
            'api_key' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
            'is_available' => 'nullable|boolean',
        ]);

        $validated['supported_states'] = $request->supported_states ?? [];
        $validated['supported_entity_types'] = $request->supported_entity_types ?? [];
        $validated['services_offered'] = $request->services_offered ?? [];
        $validated['commission_priority'] = $validated['commission_priority'] ?? 0;
        $validated['max_load'] = $validated['max_load'] ?? 100;
        $validated['status'] = $request->boolean('status', true);
        $validated['is_available'] = $request->boolean('is_available', true);

        $affiliate->update($validated);

        return redirect()->route('admin.affiliates.index')
            ->with('success', 'Affiliate updated successfully.');
    }

    public function destroy(Affiliate $affiliate)
    {
        if ($affiliate->leads()->count() > 0) {
            return back()->with('error', 'Cannot delete affiliate with assigned leads.');
        }

        $affiliate->delete();

        return redirect()->route('admin.affiliates.index')
            ->with('success', 'Affiliate deleted successfully.');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'ids' => 'required|array',
            'ids.*' => 'exists:bsf_affiliates,id',
        ]);

        $count = count($request->ids);

        Affiliate::whereIn('id', $request->ids)->whereDoesntHave('leads')->delete();

        $message = match ($request->action) {
            'delete' => "{$count} affiliate(s) deleted successfully.",
            'activate' => "{$count} affiliate(s) activated successfully.",
            'deactivate' => "{$count} affiliate(s) deactivated successfully.",
        };

        return redirect()->route('admin.affiliates.index')
            ->with('success', $message);
    }
}
