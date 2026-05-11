<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::with('state');
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")->orWhere('short_description', 'like', "%{$s}%");
            });
        }
        if ($request->filled('category')) $query->where('category', $request->category);
        if ($request->filled('state_id')) $query->where('state_id', $request->state_id);
        $resources = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $states = State::where('status', true)->orderBy('state_name')->get();
        $categories = Resource::where('status', true)->whereNotNull('category')->distinct()->pluck('category');
        return view('admin.resources.index', compact('resources', 'states', 'categories'));
    }

    public function create()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.resources.create', compact('states'));
    }

    public function store(Request $r)
    {
        $d = $r->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:resources,slug',
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'state_id' => 'nullable|exists:states,id',
            'entity_type' => 'nullable|string|max:100',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'meta_schema' => 'nullable|string|max:255',
        ]);
        $d['featured'] = $r->boolean('featured');
        $d['status'] = $r->boolean('status', true);
        if (empty($d['slug'])) $d['slug'] = Str::slug($d['title']);
        Resource::create($d);
        return redirect()->route('admin.resources.index')->with('success', 'Resource created.');
    }

    public function edit(Resource $resource)
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('admin.resources.edit', compact('resource', 'states'));
    }

    public function update(Request $r, Resource $resource)
    {
        $d = $r->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:resources,slug,' . $resource->id,
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'state_id' => 'nullable|exists:states,id',
            'entity_type' => 'nullable|string|max:100',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'meta_schema' => 'nullable|string|max:255',
        ]);
        $d['featured'] = $r->boolean('featured');
        $d['status'] = $r->boolean('status', true);
        if (empty($d['slug'])) $d['slug'] = Str::slug($d['title']);
        $resource->update($d);
        return redirect()->route('admin.resources.index')->with('success', 'Resource updated.');
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('admin.resources.index')->with('success', 'Resource deleted.');
    }
}
