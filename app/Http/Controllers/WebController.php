<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Country;
use App\Models\EntityType;
use App\Models\Industry;
use App\Mail\ContactEnquiry;
use App\Models\Page;
use App\Models\State;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $states = State::where('status', 1)->orderBy('state_name')->get();
        $entityTypes = EntityType::where('status', 1)->orderBy('name')->get();
        $industries = Industry::where('status', 1)->orderBy('name')->get();

        return view('web.screens.home', compact('states', 'entityTypes', 'industries'));
    }

    public function states()
    {
        $states = State::where('status', 1)->with('country')->orderBy('state_name')->paginate(24);
        return view('web.screens.states', compact('states'));
    }

    public function stateDetail($slug)
    {
        $state = State::where('state_slug', $slug)->where('status', 1)->firstOrFail();
        $entityTypes = EntityType::where('status', 1)->orderBy('name')->get();
        return view('web.screens.state', compact('state', 'entityTypes'));
    }

    public function entityTypes()
    {
        $entityTypes = EntityType::where('status', 1)->orderBy('name')->paginate(24);
        return view('web.screens.entity-types', compact('entityTypes'));
    }

    public function entityTypeDetail($slug)
    {
        $entityType = EntityType::where('slug', $slug)->where('status', 1)->firstOrFail();
        $states = State::where('status', 1)->orderBy('state_name')->get();
        return view('web.screens.entity-type', compact('entityType', 'states'));
    }

    public function industries()
    {
        $industries = Industry::where('status', 1)->orderBy('name')->paginate(24);
        return view('web.screens.industries', compact('industries'));
    }

    public function industryDetail($slug)
    {
        $industry = Industry::where('slug', $slug)->where('status', 1)->firstOrFail();
        $states = State::where('status', 1)->orderBy('state_name')->get();
        return view('web.screens.industry', compact('industry', 'states'));
    }

    /**
     * Display a dynamic page by slug.
     */
    public function pageDetail($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 1)->firstOrFail();

        return view('web.screens.page', compact('page'));
    }

    /**
     * Show the contact form page.
     */
    public function contact()
    {
        return view('web.screens.contact');
    }

    /**
     * Process and send the contact enquiry email.
     */
    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'captcha' => 'required|string',
        ]);

        // Verify CAPTCHA
        $storedCode = session('captcha_code');
        if (!$storedCode || strtoupper($validated['captcha']) !== $storedCode) {
            return redirect()->route('web.contact')
                ->withInput()
                ->withErrors(['captcha' => 'Incorrect CAPTCHA code. Please try again.']);
        }

        // Clear used CAPTCHA
        session()->forget('captcha_code');

        // Send email to all admin users
        $admins = \App\Models\Admin::all();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new ContactEnquiry($validated));
        }

        return redirect()->route('web.contact')
            ->with('success', 'Thank you for your enquiry! We will get back to you soon.');
    }

    /**
     * Blog listing page with sidebar (Search, Categories, Archive, Tags)
     */
    public function blog(Request $request)
    {
        $query = Blog::where('status', 'published')
            ->with(['categories', 'tags'])
            ->orderBy('published_at', 'desc');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $query->whereHas('categories', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Archive filter (year-month)
        if ($request->filled('year') && $request->filled('month')) {
            $query->whereYear('published_at', $request->input('year'))
                ->whereMonth('published_at', $request->input('month'));
        }

        // Tag filter
        if ($request->filled('tag')) {
            $tagSlug = $request->input('tag');
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        $blogs = $query->paginate(6)->withQueryString();

        // Sidebar: categories with post count
        $blogCategories = BlogCategory::where('status', 1)
            ->withCount('blogs')
            ->orderBy('name')
            ->get();

        // Sidebar: tags
        $blogTags = BlogTag::orderBy('name')->get();

        // Sidebar: archive (group by year & month)
        $archives = Blog::where('status', 'published')
            ->selectRaw("YEAR(published_at) as year, MONTH(published_at) as month, COUNT(*) as count")
            ->whereNotNull('published_at')
            ->groupBy('year', 'month')
            ->orderByRaw('year DESC, month DESC')
            ->get();

        return view('web.screens.blog', compact('blogs', 'blogCategories', 'blogTags', 'archives'));
    }

    /**
     * Single blog post detail
     */
    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->with(['categories', 'tags', 'author'])
            ->firstOrFail();

        // Recent posts for sidebar
        $recentPosts = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        // Sidebar data
        $blogCategories = BlogCategory::where('status', 1)
            ->withCount('blogs')
            ->orderBy('name')
            ->get();

        $blogTags = BlogTag::orderBy('name')->get();

        $archives = Blog::where('status', 'published')
            ->selectRaw("YEAR(published_at) as year, MONTH(published_at) as month, COUNT(*) as count")
            ->whereNotNull('published_at')
            ->groupBy('year', 'month')
            ->orderByRaw('year DESC, month DESC')
            ->get();

        return view('web.screens.blog-detail', compact('blog', 'recentPosts', 'blogCategories', 'blogTags', 'archives'));
    }
}
