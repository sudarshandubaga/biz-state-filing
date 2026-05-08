<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogTagController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogTag::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('slug', 'like', "%{$search}%");
            });
        }
        $tags = $query->orderBy('name')->paginate(15)->withQueryString();
        return view('admin.blog-tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.blog-tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:blog_tags,slug',
        ]);
        if (empty($validated['slug'])) $validated['slug'] = Str::slug($validated['name']);
        BlogTag::create($validated);
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(BlogTag $blogTag)
    {
        return view('admin.blog-tags.edit', compact('blogTag'));
    }

    public function update(Request $request, BlogTag $blogTag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:blog_tags,slug,' . $blogTag->id,
        ]);
        if (empty($validated['slug'])) $validated['slug'] = Str::slug($validated['name']);
        $blogTag->update($validated);
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(BlogTag $blogTag)
    {
        $blogTag->blogs()->detach();
        $blogTag->delete();
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag deleted successfully.');
    }
}
