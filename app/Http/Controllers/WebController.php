<?php

namespace App\Http\Controllers;

use App\Helpers\CountryHelper;
use App\Models\ComplianceDeadline;
use App\Models\Country;
use App\Models\State;
use App\Models\EntityType;
use App\Models\Industry;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Resource;
use App\Models\TaxForm;
use App\Models\EntityComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $allStates = State::where('status', true)->orderBy('state_name')->get();
        $countries = Country::where('status', true)->orderBy('country_name')->get();
        return view('web.screens.state', compact('state', 'entityTypes', 'allStates', 'countries'));
    }

    public function entityTypes()
    {
        $entityTypes = EntityType::where('status', true)->orderBy('name')->paginate(12);
        $allEntityTypes = EntityType::where('status', true)->orderBy('name')->get();
        return view('web.screens.entity-types', compact('entityTypes', 'allEntityTypes'));
    }

    public function entityTypeDetail($slug)
    {
        $entityType = EntityType::where('slug', $slug)->firstOrFail();
        $states = State::where('status', true)->orderBy('state_name')->get();
        $entityTypes = EntityType::where('status', true)->orderBy('name')->get();
        return view('web.screens.entity-type', compact('entityType', 'states', 'entityTypes'));
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
            $query->whereHas('state', function ($q) use ($state) {
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

    public function startBusiness()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        $entityTypes = EntityType::where('status', true)->get();
        $industries = Industry::where('status', true)->take(8)->get();

        return view('web.screens.start-business', compact('states', 'entityTypes', 'industries'));
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
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
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
        // Check if this is an entity comparison URL (e.g., llc-vs-s-corp)
        if (str_contains($slug, '-vs-')) {
            return $this->entityComparison($slug);
        }

        $page = Page::where('slug', $slug)->firstOrFail();
        return view('web.screens.page', compact('page'));
    }

    public function businessLicenseRequirements()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('web.screens.business-license-requirements', compact('states'));
    }

    public function registeredAgentRequirements()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('web.screens.registered-agent-requirements', compact('states'));
    }

    public function startupCostCalculator()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        return view('web.screens.startup-cost-calculator', compact('states'));
    }

    public function stateFilingDeadlines()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();
        $deadlines = ComplianceDeadline::with('state')
            ->where('status', true)
            ->orderBy('fixed_month')
            ->orderBy('fixed_day')
            ->get();
        $entityTypes = EntityType::where('status', true)->get();

        return view('web.screens.state-filing-deadlines', compact('states', 'deadlines', 'entityTypes'));
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

    /**
     * Display the entity comparison page (e.g., /llc-vs-s-corp).
     */
    public function entityComparison($slug)
    {
        // Split on "-vs-" to get the two entity type slugs
        $parts = explode('-vs-', $slug);

        if (count($parts) !== 2) {
            abort(404);
        }

        $slugPart1 = Str::slug($parts[0]);
        $slugPart2 = Str::slug($parts[1]);

        // Flexible matching - try exact slug first, then LIKE search to handle variations
        // e.g. "s-corp" matches "s-corporation", "c-corp" matches "c-corporation"
        $entityType1 = EntityType::where('status', true)
            ->where(function ($q) use ($slugPart1) {
                $q->where('slug', $slugPart1)
                    ->orWhere('slug', 'like', $slugPart1 . '%')
                    ->orWhere('slug', 'like', '%' . $slugPart1);
            })
            ->first();

        $entityType2 = EntityType::where('status', true)
            ->where(function ($q) use ($slugPart2) {
                $q->where('slug', $slugPart2)
                    ->orWhere('slug', 'like', $slugPart2 . '%')
                    ->orWhere('slug', 'like', '%' . $slugPart2);
            })
            ->first();

        if (!$entityType1 || !$entityType2) {
            abort(404);
        }

        // Fetch comparisons from the database
        $comparisons = EntityComparison::with(['entityType', 'comparedEntityType'])
            ->where(function ($q) use ($entityType1, $entityType2) {
                $q->where(function ($inner) use ($entityType1, $entityType2) {
                    $inner->where('entity_type_id', $entityType1->id)
                        ->where('compared_entity_type_id', $entityType2->id);
                })->orWhere(function ($inner) use ($entityType1, $entityType2) {
                    $inner->where('entity_type_id', $entityType2->id)
                        ->where('compared_entity_type_id', $entityType1->id);
                });
            })
            ->where('status', true)
            ->orderBy('sort_order')
            ->get();

        $comparisonTitle = $entityType1->name . ' vs ' . $entityType2->name;

        // SEO metadata
        $seo = [
            'title' => $comparisonTitle . ': Which Business Structure Is Right for You?',
            'description' => "Compare {$entityType1->name} vs {$entityType2->name}. Learn about liability protection, taxation, formation costs, and more to choose the best business structure.",
            'keywords' => "{$entityType1->name}, {$entityType2->name}, business entity comparison, {$slugPart1} vs {$slugPart2}, {$comparisonTitle}",
        ];

        return view('web.screens.entity-comparison', compact(
            'entityType1',
            'entityType2',
            'comparisons',
            'comparisonTitle',
            'seo'
        ));
    }

    public function contact()
    {
        return view('web.screens.contact');
    }

    /**
     * Switch the selected country (via topbar dropdown)
     */
    public function switchCountry($countryId)
    {
        $country = Country::findOrFail($countryId);
        CountryHelper::setSelectedCountry($country->id);

        return redirect()->back()->with('success', 'Country switched to ' . $country->country_name);
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
