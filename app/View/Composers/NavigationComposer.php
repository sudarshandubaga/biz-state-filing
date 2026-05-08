<?php

namespace App\View\Composers;

use App\Models\EntityType;
use App\Models\Industry;
use App\Models\Page;
use App\Models\State;
use Illuminate\View\View;

class NavigationComposer
{
    protected $states;
    protected $entityTypes;
    protected $industries;
    protected $pages;

    public function __construct()
    {
        $this->states = State::where('status', 1)->orderBy('state_name')->get();
        $this->entityTypes = EntityType::where('status', 1)->orderBy('name')->get();
        $this->industries = Industry::where('status', 1)->orderBy('name')->get();
        $this->pages = Page::where('status', 1)->orderBy('title')->get();
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $view->with('navStates', $this->states)
            ->with('navEntityTypes', $this->entityTypes)
            ->with('navIndustries', $this->industries)
            ->with('navPages', $this->pages);
    }
}
