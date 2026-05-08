<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['categories', 'tags', 'author']);
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category_id')) {
            $query->whereHas('categories', fn($q) => $q->where('blog_category_id', $request->category_id));
        }
        $blogs = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $categories = BlogCategory::where('status', true)->orderBy('name')->get();
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status', true)->orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'featured_image_alt' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'new_tags' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) $validated['slug'] = Str::slug($validated['title']);

        // Handle featured image upload with resize & WebP
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = Str::uuid() . '.webp';
            $path = storage_path('app/public/blogs/' . $filename);

            $img = Image::read($image->getRealPath());
            if ($img->width() > 1200) {
                $img->scale(width: 1200);
            }
            $img->toWebp(80)->save($path);
            $validated['featured_image'] = 'blogs/' . $filename;
        }

        if (empty($validated['published_at']) && $validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $blog = Blog::create($validated);

        // Sync categories
        if (!empty($validated['categories'])) {
            $blog->categories()->sync($validated['categories']);
        }

        // Sync existing tags & create new ones
        $tagIds = $validated['tags'] ?? [];
        if (!empty($validated['new_tags'])) {
            $newTagNames = array_map('trim', explode(',', $validated['new_tags']));
            foreach ($newTagNames as $name) {
                if (!empty($name)) {
                    $tag = BlogTag::firstOrCreate(
                        ['slug' => Str::slug($name)],
                        ['name' => $name]
                    );
                    $tagIds[] = $tag->id;
                }
            }
        }
        if (!empty($tagIds)) {
            $blog->tags()->sync($tagIds);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $blog->load(['categories', 'tags']);
        $categories = BlogCategory::where('status', true)->orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'featured_image_alt' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'new_tags' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) $validated['slug'] = Str::slug($validated['title']);

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $image = $request->file('featured_image');
            $filename = Str::uuid() . '.webp';
            $path = storage_path('app/public/blogs/' . $filename);

            $img = Image::read($image->getRealPath());
            if ($img->width() > 1200) {
                $img->scale(width: 1200);
            }
            $img->toWebp(80)->save($path);
            $validated['featured_image'] = 'blogs/' . $filename;
        }

        if (empty($validated['published_at']) && $validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        // Sync categories
        $blog->categories()->sync($validated['categories'] ?? []);

        // Sync tags + create new ones
        $tagIds = $validated['tags'] ?? [];
        if (!empty($validated['new_tags'])) {
            $newTagNames = array_map('trim', explode(',', $validated['new_tags']));
            foreach ($newTagNames as $name) {
                if (!empty($name)) {
                    $tag = BlogTag::firstOrCreate(
                        ['slug' => Str::slug($name)],
                        ['name' => $name]
                    );
                    $tagIds[] = $tag->id;
                }
            }
        }
        $blog->tags()->sync($tagIds);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        $blog->categories()->detach();
        $blog->tags()->detach();
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    // TinyMCE editor image upload handler
    public function uploadEditorImage(Request $request)
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240']);
        $image = $request->file('image');
        $filename = Str::uuid() . '.webp';
        $path = storage_path('app/public/editor-images/' . $filename);

        $img = Image::read($image->getRealPath());
        if ($img->width() > 1920) {
            $img->scale(width: 1920);
        }
        $img->toWebp(80)->save($path);

        $url = asset('storage/editor-images/' . $filename);
        return response()->json(['location' => $url]);
    }
}
