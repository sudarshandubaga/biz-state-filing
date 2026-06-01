<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Country::withCount('states');

        // Filter by search term
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('country_name', 'like', "%{$search}%")
                    ->orWhere('country_slug', 'like', "%{$search}%")
                    ->orWhere('iso_code', 'like', "%{$search}%");
            });
        }

        // Filter by world region
        if ($request->filled('world_region')) {
            $query->where('world_region', $request->world_region);
        }

        // Sort
        $sortField = $request->get('sort', 'country_name');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $countries = $query->paginate(15)->withQueryString();

        return view('admin.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_name' => 'required|string|max:120',
            'short_name' => 'required|string|max:2',
            'country_slug' => 'nullable|string|max:120|unique:countries,country_slug',
            'flag_image' => 'nullable|image|mimes:png,jpeg,gif,svg,webp|max:2048',
            'iso_code' => 'nullable|string|max:5',
            'currency' => 'nullable|string|max:10',
            'world_region' => 'nullable|string|max:100',
            'status' => 'boolean',
        ]);

        if (empty($validated['country_slug'])) {
            $validated['country_slug'] = Str::slug($validated['country_name']);
        }

        // Handle flag image upload
        if ($request->hasFile('flag_image')) {
            $file = $request->file('flag_image');
            $filename = time() . '_' . $validated['short_name'] . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/countries'), $filename);
            $validated['flag_image'] = $filename;
        }

        Country::create($validated);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $country->load('states');
        return view('admin.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'country_name' => 'required|string|max:120',
            'short_name' => 'required|string|max:2',
            'country_slug' => 'nullable|string|max:120|unique:countries,country_slug,' . $country->id,
            'flag_image' => 'nullable|image|mimes:png,jpeg,gif,svg,webp|max:2048',
            'iso_code' => 'nullable|string|max:5',
            'currency' => 'nullable|string|max:10',
            'world_region' => 'nullable|string|max:100',
            'status' => 'boolean',
        ]);

        if (empty($validated['country_slug'])) {
            $validated['country_slug'] = Str::slug($validated['country_name']);
        }

        // Handle flag image upload
        if ($request->hasFile('flag_image')) {
            // Delete old flag image
            if ($country->flag_image && file_exists(public_path('uploads/countries/' . $country->flag_image))) {
                unlink(public_path('uploads/countries/' . $country->flag_image));
            }

            $file = $request->file('flag_image');
            $filename = time() . '_' . $validated['short_name'] . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/countries'), $filename);
            $validated['flag_image'] = $filename;
        }

        $country->update($validated);

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        if ($country->states()->count() > 0) {
            return back()->with('error', 'Cannot delete country with associated states.');
        }

        // Delete flag image
        if ($country->flag_image && file_exists(public_path('uploads/countries/' . $country->flag_image))) {
            unlink(public_path('uploads/countries/' . $country->flag_image));
        }

        $country->delete();

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country deleted successfully.');
    }

    /**
     * Bulk actions (delete, activate, deactivate).
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,deactivate',
            'ids' => 'required|array',
            'ids.*' => 'exists:countries,id',
        ]);

        $count = count($request->ids);

        match ($request->action) {
            'delete' => Country::whereIn('id', $request->ids)->doesntHave('states')->delete(),
            'activate' => Country::whereIn('id', $request->ids)->update(['status' => 1]),
            'deactivate' => Country::whereIn('id', $request->ids)->update(['status' => 0]),
        };

        $message = match ($request->action) {
            'delete' => "{$count} country(s) deleted successfully.",
            'activate' => "{$count} country(s) activated successfully.",
            'deactivate' => "{$count} country(s) deactivated successfully.",
        };

        return redirect()->route('admin.countries.index')
            ->with('success', $message);
    }
}
