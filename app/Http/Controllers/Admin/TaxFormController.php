<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\TaxForm;
use Illuminate\Http\Request;

class TaxFormController extends Controller
{
    public function index(Request $request)
    {
        $query = TaxForm::with('state');
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('form_name', 'like', "%{$s}%")->orWhere('form_number', 'like', "%{$s}%");
            });
        }
        if ($request->filled('category')) $query->where('category', $request->category);
        if ($request->filled('state_id')) $query->where('state_id', $request->state_id);
        $forms = $query->orderBy('form_name')->paginate(15)->withQueryString();
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.tax-forms.index', compact('forms', 'states'));
    }
    public function create()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.tax-forms.create', compact('states'));
    }
    public function store(Request $r)
    {
        $d = $r->validate(['form_name' => 'required|string|max:255', 'form_number' => 'nullable|string|max:100', 'description' => 'nullable|string', 'category' => 'required|in:formation,compliance,tax', 'state_id' => 'nullable|exists:states,id', 'entity_type' => 'nullable|string|max:100', 'download_url' => 'nullable|url|max:500', 'is_official' => 'nullable|boolean', 'official_url' => 'nullable|url|max:500', 'status' => 'nullable|boolean']);
        $d['is_official'] = $r->boolean('is_official', true);
        $d['status'] = $r->boolean('status', true);
        TaxForm::create($d);
        return redirect()->route('admin.tax-forms.index')->with('success', 'Tax form created.');
    }
    public function edit(TaxForm $taxForm)
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.tax-forms.edit', compact('taxForm', 'states'));
    }
    public function update(Request $r, TaxForm $taxForm)
    {
        $d = $r->validate(['form_name' => 'required|string|max:255', 'form_number' => 'nullable|string|max:100', 'description' => 'nullable|string', 'category' => 'required|in:formation,compliance,tax', 'state_id' => 'nullable|exists:states,id', 'entity_type' => 'nullable|string|max:100', 'download_url' => 'nullable|url|max:500', 'is_official' => 'nullable|boolean', 'official_url' => 'nullable|url|max:500', 'status' => 'nullable|boolean']);
        $d['is_official'] = $r->boolean('is_official', true);
        $d['status'] = $r->boolean('status', true);
        $taxForm->update($d);
        return redirect()->route('admin.tax-forms.index')->with('success', 'Tax form updated.');
    }
    public function destroy(TaxForm $taxForm)
    {
        $taxForm->delete();
        return redirect()->route('admin.tax-forms.index')->with('success', 'Tax form deleted.');
    }
}
