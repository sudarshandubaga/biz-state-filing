<?php

namespace App\Http\Controllers;

use App\Models\ComplianceDeadline;
use App\Models\State;
use App\Models\EntityType;
use App\Models\Industry;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Resource;
use App\Models\TaxForm;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $states = State::where('status', true)->orderBy('state_name')->take(6)->get();
        $entityTypes = EntityType::where('status', true)->take(4)->get();
        $industries = Industry::where('status', true)->take(6)->get();
        
        return view('web.screens.home', compact('states', 'entityTypes', 'industries'));
    }

    public function states()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('web.screens.states', compact('states'));
    }

    public function stateDetail($slug)
    {
        $state = State::where('state_slug', $slug)->firstOrFail();
        $entityTypes = EntityType::where('status', true)->get();
        return view('web.screens.state', compact('state', 'entityTypes'));
    }

    public function entityTypes()
    {
        $entityTypes = EntityType::where('status', true)->get();
        return view('web.screens.entity-types', compact('entityTypes'));
    }

    public function entityTypeDetail($slug)
    {
        $entityType = EntityType::where('slug', $slug)->firstOrFail();
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('web.screens.entity-type', compact('entityType', 'states'));
    }

    public function industries()
    {
        $industries = Industry::where('status', true)->get();
        return view('web.screens.industries', compact('industries'));
    }

    public function industryDetail($slug)
    {
        $industry = Industry::where('slug', $slug)->firstOrFail();
        return view('web.screens.industry', compact('industry'));
    }

    public function taxForms(Request $request, $state = null, $entityType = null)
    {
        $query = TaxForm::with('state')->where('status', true);

        if ($state) {
            $query->whereHas('state', function($q) use ($state) {
                $q->where('state_slug', $state);
            });
        }

        if ($entityType) {
            $query->where('entity_type', $entityType);
        }

        $forms = $query->orderBy('form_name')->get();
        $states = State::where('status', true)->orderBy('state_name')->get();
        
        return view('web.screens.forms-library', compact('forms', 'states'));
    }

    public function complianceCalendar(Request $request)
    {
        $query = ComplianceDeadline::with('state')->where('status', true);

        if ($request->has('state_id')) {
            $query->where('state_id', $request->state_id);
        }

        if ($request->has('entity_type')) {
            $query->where('entity_type', $request->entity_type);
        }

        $deadlines = $query->orderBy('fixed_month')->orderBy('fixed_day')->get();
        $states = State::where('status', true)->orderBy('state_name')->get();
        
        $entityTypes = ComplianceDeadline::where('status', true)
            ->whereNotNull('entity_type')
            ->distinct()
            ->pluck('entity_type');

        $complianceData = $deadlines->map(function ($d) {
            return [
                'month' => $d->fixed_month ?: 1,
                'state' => $d->state ? $d->state->state_name : 'Federal',
                'entity' => $d->entity_type ?: 'All',
                'title' => $d->deadline_name,
                'desc' => $d->description ?: '',
                'day' => $d->fixed_day ?: 1,
                'status' => ($d->fixed_month == now()->month) ? 'urgent' : 'upcoming'
            ];
        });

        return view('web.screens.compliance-calendar', compact('deadlines', 'states', 'entityTypes', 'complianceData'));
    }

    public function einGuide()
    {
        return view('web.screens.ein-guide');
    }

    public function onlyTaxForms(Request $request)
    {
        $query = TaxForm::with('state')->where('status', true)->where('category', 'tax');

        if ($request->has('state_id')) {
            $query->where('state_id', $request->state_id);
        }

        $forms = $query->orderBy('form_name')->get();
        $states = State::where('status', true)->orderBy('state_name')->get();
        
        return view('web.screens.tax-forms', compact('forms', 'states'));
    }

    public function blog(Request $request)
    {
        $query = Blog::where('status', 'published');

        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $blogCategories = \App\Models\BlogCategory::withCount('blogs')->get();
        $blogTags = \App\Models\BlogTag::all();
        $archives = Blog::where('status', 'published')
            ->selectRaw('year(created_at) year, month(created_at) month, count(*) count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('web.screens.blog', compact('blogs', 'blogCategories', 'blogTags', 'archives'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blogCategories = \App\Models\BlogCategory::withCount('blogs')->get();
        $blogTags = \App\Models\BlogTag::all();
        
        return view('web.screens.blog-detail', compact('blog', 'blogCategories', 'blogTags'));
    }

    public function pageDetail($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('web.screens.page', compact('page'));
    }

    public function resources()
    {
        $resources = Resource::where('status', true)->get();
        return view('web.screens.resources', compact('resources'));
    }

    public function resourceDetail($slug)
    {
        $resource = Resource::where('slug', $slug)->firstOrFail();
        return view('web.screens.resource-detail', compact('resource'));
    }

    public function contact()
    {
        return view('web.screens.contact');
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
