<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplianceDeadline;
use App\Models\State;
use Illuminate\Http\Request;

class ComplianceDeadlineController extends Controller
{
    public function index(Request $r)
    {
        $q = ComplianceDeadline::with('state');
        if ($r->filled('search')) {
            $s = $r->search;
            $q->where(function ($q) use ($s) {
                $q->where('deadline_name', 'like', "%{$s}%");
            });
        }
        if ($r->filled('state_id')) $q->where('state_id', $r->state_id);
        if ($r->filled('category')) $q->where('category', $r->category);
        $deadlines = $q->orderBy('state_id')->orderBy('sort_order')->paginate(15)->withQueryString();
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.compliance-deadlines.index', compact('deadlines', 'states'));
    }
    public function create()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.compliance-deadlines.create', compact('states'));
    }
    public function store(Request $r)
    {
        $d = $r->validate(['deadline_name' => 'required|string|max:255', 'description' => 'nullable|string', 'state_id' => 'nullable|exists:states,id', 'entity_type' => 'nullable|string|max:100', 'deadline_type' => 'required|in:static,dynamic', 'fixed_month' => 'nullable|integer|min:1|max:12', 'fixed_day' => 'nullable|integer|min:1|max:31', 'rule_label' => 'nullable|string|max:255', 'rule_type' => 'required|in:fixed,days_after_formation,days_after_fy_end,anniversary', 'rule_days' => 'nullable|integer|min:0', 'category' => 'required|string|max:100', 'sort_order' => 'nullable|integer|min:0', 'status' => 'nullable|boolean']);
        $d['status'] = $r->boolean('status', true);
        ComplianceDeadline::create($d);
        return redirect()->route('admin.compliance-deadlines.index')->with('success', 'Deadline created.');
    }
    public function edit(ComplianceDeadline $complianceDeadline)
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.compliance-deadlines.edit', compact('complianceDeadline', 'states'));
    }
    public function update(Request $r, ComplianceDeadline $complianceDeadline)
    {
        $d = $r->validate(['deadline_name' => 'required|string|max:255', 'description' => 'nullable|string', 'state_id' => 'nullable|exists:states,id', 'entity_type' => 'nullable|string|max:100', 'deadline_type' => 'required|in:static,dynamic', 'fixed_month' => 'nullable|integer|min:1|max:12', 'fixed_day' => 'nullable|integer|min:1|max:31', 'rule_label' => 'nullable|string|max:255', 'rule_type' => 'required|in:fixed,days_after_formation,days_after_fy_end,anniversary', 'rule_days' => 'nullable|integer|min:0', 'category' => 'required|string|max:100', 'sort_order' => 'nullable|integer|min:0', 'status' => 'nullable|boolean']);
        $d['status'] = $r->boolean('status', true);
        $complianceDeadline->update($d);
        return redirect()->route('admin.compliance-deadlines.index')->with('success', 'Deadline updated.');
    }
    public function destroy(ComplianceDeadline $complianceDeadline)
    {
        $complianceDeadline->delete();
        return redirect()->route('admin.compliance-deadlines.index')->with('success', 'Deadline deleted.');
    }
}
