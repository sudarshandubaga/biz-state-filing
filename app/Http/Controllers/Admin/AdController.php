<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Affiliate;
use App\Models\State;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $query = Ad::with('affiliate');
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")->orWhere('placement', 'like', "%{$s}%");
            });
        }
        if ($request->filled('placement')) $query->where('placement', $request->placement);
        if ($request->filled('category')) $query->where('category', $request->category);
        if ($request->filled('status')) $query->where('status', $request->status == 'active');
        $ads = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        $affiliates = Affiliate::where('status', true)->orderBy('name')->get();
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.ads.create', compact('affiliates', 'states'));
    }

    public function store(Request $r)
    {
        $d = $r->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:500',
            'ad_type' => 'required|string|max:50',
            'target_url' => 'nullable|string|max:500',
            'placement' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'states_targeting' => 'nullable|array',
            'states_targeting.*' => 'string|max:2',
            'device_targeting' => 'required|in:all,mobile,desktop',
            'weight' => 'required|integer|min:1|max:100',
            'utm_source' => 'nullable|string|max:255',
            'utm_medium' => 'nullable|string|max:255',
            'utm_campaign' => 'nullable|string|max:255',
            'affiliate_id' => 'nullable|exists:affiliates,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'max_impressions' => 'nullable|integer|min:0',
            'max_clicks' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);
        $d['status'] = $r->boolean('status', true);
        if (empty($d['states_targeting'])) $d['states_targeting'] = null;
        Ad::create($d);
        return redirect()->route('admin.ads.index')->with('success', 'Ad created successfully.');
    }

    public function edit(Ad $ad)
    {
        $affiliates = Affiliate::where('status', true)->orderBy('name')->get();
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.ads.edit', compact('ad', 'affiliates', 'states'));
    }

    public function update(Request $r, Ad $ad)
    {
        $d = $r->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:500',
            'ad_type' => 'required|string|max:50',
            'target_url' => 'nullable|string|max:500',
            'placement' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'states_targeting' => 'nullable|array',
            'states_targeting.*' => 'string|max:2',
            'device_targeting' => 'required|in:all,mobile,desktop',
            'weight' => 'required|integer|min:1|max:100',
            'utm_source' => 'nullable|string|max:255',
            'utm_medium' => 'nullable|string|max:255',
            'utm_campaign' => 'nullable|string|max:255',
            'affiliate_id' => 'nullable|exists:affiliates,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'max_impressions' => 'nullable|integer|min:0',
            'max_clicks' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);
        $d['status'] = $r->boolean('status', true);
        if (empty($d['states_targeting'])) $d['states_targeting'] = null;
        $ad->update($d);
        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully.');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('admin.ads.index')->with('success', 'Ad deleted.');
    }
}
