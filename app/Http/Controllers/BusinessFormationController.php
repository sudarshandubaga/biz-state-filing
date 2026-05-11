<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Lead;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BusinessFormationController extends Controller
{
    /**
     * Display the start page (Step 0).
     */
    public function index()
    {
        return view('web.formation.index');
    }

    /**
     * Step 1 - Select Entity Type
     */
    public function step1EntityType()
    {
        $entityTypes = [
            'llc' => 'LLC (Limited Liability Company)',
            's-corporation' => 'S Corporation',
            'c-corporation' => 'C Corporation',
            'partnership' => 'Partnership',
            'sole-proprietorship' => 'Sole Proprietorship',
            'professional-entity' => 'Professional Entity (PLLC / PC)',
            'foreign-qualification' => 'Foreign Qualification',
        ];

        return view('web.formation.step1-entity-type', compact('entityTypes'));
    }

    /**
     * Store Step 1 - Save entity type selection
     */
    public function postStep1EntityType(Request $request)
    {
        $request->validate([
            'entity_type' => 'required|in:llc,s-corporation,c-corporation,partnership,sole-proprietorship,professional-entity,foreign-qualification',
        ]);

        session(['formation.entity_type' => $request->entity_type]);

        return redirect()->route('formation.step2');
    }

    /**
     * Step 2 - Select State of Formation
     */
    public function step2State()
    {
        $states = State::where('status', true)->orderBy('state_name')->get();

        return view('web.formation.step2-state', compact('states'));
    }

    /**
     * Store Step 2 - Save state selection
     */
    public function postStep2State(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
        ]);

        session(['formation.state_id' => $request->state_id]);

        return redirect()->route('formation.step3');
    }

    /**
     * Step 3 - Universal Questions
     */
    public function step3Universal()
    {
        $entityType = session('formation.entity_type', 'llc');
        $stateId = session('formation.state_id');
        $state = $stateId ? State::find($stateId) : null;

        return view('web.formation.step3-universal', compact('entityType', 'state'));
    }

    /**
     * Store Step 3 - Save universal questions
     */
    public function postStep3Universal(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'name_available' => 'nullable|boolean',
            'needs_registered_agent' => 'nullable|boolean',
            'business_address' => 'nullable|string|max:500',
            'needs_ein' => 'nullable|boolean',
            'needs_annual_report_assistance' => 'nullable|boolean',
        ]);

        session([
            'formation.business_name' => $request->business_name,
            'formation.name_available' => $request->boolean('name_available'),
            'formation.needs_registered_agent' => $request->boolean('needs_registered_agent'),
            'formation.business_address' => $request->business_address,
            'formation.needs_ein' => $request->boolean('needs_ein'),
            'formation.needs_annual_report_assistance' => $request->boolean('needs_annual_report_assistance'),
        ]);

        return redirect()->route('formation.step4');
    }

    /**
     * Step 4 - Entity Specific Branching
     */
    public function step4Specific()
    {
        $entityType = session('formation.entity_type', 'llc');

        return view('web.formation.step4-specific', compact('entityType'));
    }

    /**
     * Store Step 4 - Save entity-specific data
     */
    public function postStep4Specific(Request $request)
    {
        $entityType = session('formation.entity_type', 'llc');

        $rules = $this->getEntitySpecificRules($entityType);
        $validated = $request->validate($rules);

        $entitySpecificData = $this->extractEntitySpecificData($entityType, $validated);
        session(['formation.entity_specific_data' => $entitySpecificData]);

        return redirect()->route('formation.step5');
    }

    /**
     * Step 5 - Review Summary
     */
    public function step5Review()
    {
        $formation = session('formation', []);
        $state = isset($formation['state_id']) ? State::find($formation['state_id']) : null;

        if (empty($formation) || !isset($formation['entity_type'])) {
            return redirect()->route('formation.step1')
                ->with('error', 'Please start from the beginning.');
        }

        // Build summary data
        $summary = $this->buildSummary($formation, $state);

        return view('web.formation.step5-review', compact('formation', 'state', 'summary'));
    }

    /**
     * Store Step 5 - Finalize and proceed to affiliate matching
     */
    public function postStep5Review(Request $request)
    {
        $formation = session('formation', []);

        if (empty($formation) || !isset($formation['entity_type']) || !isset($formation['state_id'])) {
            return redirect()->route('formation.step1')
                ->with('error', 'Session expired. Please start again.');
        }

        // Create the lead record
        $lead = Lead::create([
            'entity_type' => $formation['entity_type'],
            'state_id' => $formation['state_id'],
            'business_name' => $formation['business_name'] ?? '',
            'name_available' => $formation['name_available'] ?? null,
            'needs_registered_agent' => $formation['needs_registered_agent'] ?? false,
            'business_address' => $formation['business_address'] ?? null,
            'needs_ein' => $formation['needs_ein'] ?? false,
            'needs_annual_report_assistance' => $formation['needs_annual_report_assistance'] ?? false,
            'entity_specific_data' => $formation['entity_specific_data'] ?? [],
            'summary_data' => $this->buildSummary($formation, State::find($formation['state_id'])),
            'status' => 'in_progress',
            'session_id' => session()->getId(),
        ]);

        session(['formation.lead_id' => $lead->id]);

        // Proceed to affiliate matching (Step 6)
        return redirect()->route('formation.step6');
    }

    /**
     * Step 6 - Affiliate Matching Engine
     */
    public function step6Matching()
    {
        $leadId = session('formation.lead_id');
        if (!$leadId) {
            return redirect()->route('formation.step1')
                ->with('error', 'Session expired. Please start again.');
        }

        $lead = Lead::findOrFail($leadId);
        $matchedAffiliates = $this->matchAffiliates($lead);

        // Store matched affiliates
        $lead->update([
            'matched_affiliates' => $matchedAffiliates,
            'status' => 'matched',
        ]);

        return view('web.formation.step6-matching', compact('lead', 'matchedAffiliates'));
    }

    /**
     * Store Step 6 - Confirm affiliate selection
     */
    public function postStep6Matching(Request $request)
    {
        $leadId = session('formation.lead_id');
        $lead = Lead::findOrFail($leadId);

        $selectedAffiliateId = $request->input('selected_affiliate_id');
        $routingMethod = $request->input('routing_method', 'single');

        session([
            'formation.selected_affiliate_id' => $selectedAffiliateId,
            'formation.routing_method' => $routingMethod,
        ]);

        return redirect()->route('formation.step7');
    }

    /**
     * Step 7 - Lead Routing
     */
    public function step7Routing()
    {
        $leadId = session('formation.lead_id');
        if (!$leadId) {
            return redirect()->route('formation.step1')
                ->with('error', 'Session expired. Please start again.');
        }

        $lead = Lead::findOrFail($leadId);
        $selectedAffiliateId = session('formation.selected_affiliate_id');

        return view('web.formation.step7-routing', compact('lead', 'selectedAffiliateId'));
    }

    /**
     * Store Step 7 - Execute routing
     */
    public function postStep7Routing(Request $request)
    {
        $leadId = session('formation.lead_id');
        $lead = Lead::findOrFail($leadId);

        $selectedAffiliateId = session('formation.selected_affiliate_id');
        $routingMethod = session('formation.routing_method', 'single');

        // Perform routing
        $routedAffiliateId = $this->routeLead($lead, $selectedAffiliateId, $routingMethod);

        $lead->update([
            'routing_method' => $routingMethod,
            'routed_to_affiliate_id' => $routedAffiliateId,
            'status' => 'routed',
        ]);

        session(['formation.routed_affiliate_id' => $routedAffiliateId]);

        return redirect()->route('formation.step8');
    }

    /**
     * Step 8 - Lead Sent to Partner(s)
     */
    public function step8Sent()
    {
        $leadId = session('formation.lead_id');
        if (!$leadId) {
            return redirect()->route('formation.step1')
                ->with('error', 'Session expired. Please start again.');
        }

        $lead = Lead::with('routedAffiliate')->findOrFail($leadId);

        // Send the lead to partner if not already sent
        if (!$lead->sent_to_partner) {
            $this->sendLeadToPartner($lead);
        }

        return view('web.formation.step8-sent', compact('lead'));
    }

    /**
     * Start over - clear formation session data
     */
    public function startOver()
    {
        session()->forget('formation');
        return redirect()->route('formation.step1');
    }

    /**
     * Go back to a specific step
     */
    public function goToStep($step)
    {
        $validSteps = [1, 2, 3, 4, 5];
        if (in_array($step, $validSteps)) {
            return redirect()->route('formation.step' . $step);
        }

        return redirect()->route('formation.step1');
    }

    // ========== PRIVATE HELPER METHODS ==========

    /**
     * Get validation rules for entity-specific step
     */
    private function getEntitySpecificRules(string $entityType): array
    {
        $rules = match ($entityType) {
            'llc' => [
                'membership_type' => 'required|in:single-multi',
                'management_type' => 'required|in:member-managed,manager-managed',
                'needs_operating_agreement' => 'nullable|boolean',
                'naics_code' => 'nullable|string|max:10',
            ],
            's-corporation' => [
                'shareholders_count' => 'required|integer|min:1|max:100',
                'all_citizens' => 'nullable|boolean',
                'fiscal_year' => 'nullable|string|max:50',
                'needs_2553_election' => 'nullable|boolean',
            ],
            'c-corporation' => [
                'authorized_shares' => 'required|integer|min:1',
                'par_value' => 'required|numeric|min:0',
                'directors_count' => 'required|integer|min:1',
                'needs_bylaws' => 'nullable|boolean',
            ],
            'partnership' => [
                'partnership_type' => 'required|in:general,limited',
                'partners_count' => 'required|integer|min:2',
                'needs_partnership_agreement' => 'nullable|boolean',
            ],
            'sole-proprietorship' => [
                'dba_name' => 'nullable|string|max:255',
                'needs_local_license' => 'nullable|boolean',
                'tax_id_type' => 'required|in:ein,ssn',
            ],
            'professional-entity' => [
                'profession_type' => 'required|string|max:255',
                'has_license' => 'nullable|boolean',
                'license_number' => 'nullable|string|max:100',
            ],
            'foreign-qualification' => [
                'home_state_id' => 'required|exists:states,id',
                'foreign_state_id' => 'required|exists:states,id|different:home_state_id',
                'has_certificate_of_good_standing' => 'nullable|boolean',
            ],
            default => [],
        };

        return $rules;
    }

    /**
     * Extract entity-specific data from validated input
     */
    private function extractEntitySpecificData(string $entityType, array $validated): array
    {
        $data = [];

        switch ($entityType) {
            case 'llc':
                $data = [
                    'membership_type' => $validated['membership_type'] ?? 'single-multi',
                    'management_type' => $validated['management_type'] ?? 'member-managed',
                    'needs_operating_agreement' => (bool)($validated['needs_operating_agreement'] ?? false),
                    'naics_code' => $validated['naics_code'] ?? null,
                ];
                break;
            case 's-corporation':
                $data = [
                    'shareholders_count' => $validated['shareholders_count'] ?? 1,
                    'all_citizens' => (bool)($validated['all_citizens'] ?? false),
                    'fiscal_year' => $validated['fiscal_year'] ?? 'calendar',
                    'needs_2553_election' => (bool)($validated['needs_2553_election'] ?? false),
                ];
                break;
            case 'c-corporation':
                $data = [
                    'authorized_shares' => $validated['authorized_shares'] ?? 1000,
                    'par_value' => $validated['par_value'] ?? 0.01,
                    'directors_count' => $validated['directors_count'] ?? 1,
                    'needs_bylaws' => (bool)($validated['needs_bylaws'] ?? false),
                ];
                break;
            case 'partnership':
                $data = [
                    'partnership_type' => $validated['partnership_type'] ?? 'general',
                    'partners_count' => $validated['partners_count'] ?? 2,
                    'needs_partnership_agreement' => (bool)($validated['needs_partnership_agreement'] ?? false),
                ];
                break;
            case 'sole-proprietorship':
                $data = [
                    'dba_name' => $validated['dba_name'] ?? null,
                    'needs_local_license' => (bool)($validated['needs_local_license'] ?? false),
                    'tax_id_type' => $validated['tax_id_type'] ?? 'ssn',
                ];
                break;
            case 'professional-entity':
                $data = [
                    'profession_type' => $validated['profession_type'] ?? '',
                    'has_license' => (bool)($validated['has_license'] ?? false),
                    'license_number' => $validated['license_number'] ?? null,
                ];
                break;
            case 'foreign-qualification':
                $data = [
                    'home_state_id' => $validated['home_state_id'] ?? null,
                    'foreign_state_id' => $validated['foreign_state_id'] ?? null,
                    'has_certificate_of_good_standing' => (bool)($validated['has_certificate_of_good_standing'] ?? false),
                ];
                break;
        }

        return $data;
    }

    /**
     * Build summary data array
     */
    private function buildSummary(array $formation, $state): array
    {
        $entityLabels = [
            'llc' => 'LLC (Limited Liability Company)',
            's-corporation' => 'S Corporation',
            'c-corporation' => 'C Corporation',
            'partnership' => 'Partnership',
            'sole-proprietorship' => 'Sole Proprietorship',
            'professional-entity' => 'Professional Entity (PLLC / PC)',
            'foreign-qualification' => 'Foreign Qualification',
        ];

        return [
            'entity_type' => $formation['entity_type'] ?? '',
            'entity_type_label' => $entityLabels[$formation['entity_type'] ?? ''] ?? '',
            'state' => $state ? $state->state_name : '',
            'business_name' => $formation['business_name'] ?? '',
            'name_available' => $formation['name_available'] ?? null,
            'needs_registered_agent' => $formation['needs_registered_agent'] ?? false,
            'business_address' => $formation['business_address'] ?? '',
            'needs_ein' => $formation['needs_ein'] ?? false,
            'needs_annual_report_assistance' => $formation['needs_annual_report_assistance'] ?? false,
            'entity_specific' => $formation['entity_specific_data'] ?? [],
        ];
    }

    /**
     * Match affiliates based on lead criteria (Step 6 engine)
     */
    private function matchAffiliates(Lead $lead): array
    {
        $affiliates = Affiliate::where('status', true)
            ->where('is_available', true)
            ->get();

        $scored = [];

        foreach ($affiliates as $affiliate) {
            $score = 0;

            // Match by state
            $supportedStates = $affiliate->supported_states ?? [];
            if (in_array($lead->state_id, $supportedStates)) {
                $score += 30;
            } else if (empty($supportedStates)) {
                $score += 10; // no state restriction = partial match
            }

            // Match by entity type
            $supportedTypes = $affiliate->supported_entity_types ?? [];
            if (in_array($lead->entity_type, $supportedTypes)) {
                $score += 30;
            } else if (empty($supportedTypes)) {
                $score += 10;
            }

            // Match by services needed
            $servicesNeeded = [];
            if ($lead->needs_registered_agent) $servicesNeeded[] = 'registered-agent';
            if ($lead->needs_ein) $servicesNeeded[] = 'ein';
            if ($lead->needs_annual_report_assistance) $servicesNeeded[] = 'annual-report';

            $offeredServices = $affiliate->services_offered ?? [];
            $serviceScore = 0;
            foreach ($servicesNeeded as $service) {
                if (in_array($service, $offeredServices)) {
                    $serviceScore += 15;
                }
            }
            $score += $serviceScore;

            // Commission priority bonus
            $score += $affiliate->commission_priority;

            // Load balancing penalty (lower is better)
            $loadRatio = $affiliate->max_load > 0 ? $affiliate->current_load / $affiliate->max_load : 1;
            $score -= ($loadRatio * 20);

            $scored[] = [
                'affiliate_id' => $affiliate->id,
                'name' => $affiliate->name,
                'company' => $affiliate->company,
                'email' => $affiliate->email,
                'website' => $affiliate->website,
                'score' => max(0, $score),
                'current_load' => $affiliate->current_load,
                'max_load' => $affiliate->max_load,
            ];
        }

        // Sort by score descending, return top 3
        usort($scored, fn($a, $b) => $b['score'] <=> $a['score']);

        return array_slice($scored, 0, 3);
    }

    /**
     * Route lead to affiliate(s) (Step 7)
     */
    private function routeLead(Lead $lead, ?int $selectedAffiliateId, string $method): ?int
    {
        switch ($method) {
            case 'single':
                // Route to the single selected affiliate
                if ($selectedAffiliateId) {
                    $this->incrementAffiliateLoad($selectedAffiliateId);
                    return $selectedAffiliateId;
                }

                // Auto-select best match if none selected
                $matches = $lead->matched_affiliates ?? [];
                if (!empty($matches)) {
                    $bestId = $matches[0]['affiliate_id'];
                    $this->incrementAffiliateLoad($bestId);
                    return $bestId;
                }
                break;

            case 'multi':
                // Route to all matched affiliates (just store first as primary)
                if ($selectedAffiliateId) {
                    $this->incrementAffiliateLoad($selectedAffiliateId);
                    return $selectedAffiliateId;
                }
                break;

            case 'weighted':
                // Use weighted random selection based on scores
                $matches = $lead->matched_affiliates ?? [];
                if (!empty($matches)) {
                    $weights = array_column($matches, 'score');
                    $totalWeight = array_sum($weights);
                    if ($totalWeight > 0) {
                        $random = mt_rand(1, $totalWeight);
                        $cumulative = 0;
                        foreach ($matches as $i => $match) {
                            $cumulative += $match['score'];
                            if ($random <= $cumulative) {
                                $this->incrementAffiliateLoad($match['affiliate_id']);
                                return $match['affiliate_id'];
                            }
                        }
                    }
                }
                break;
        }

        return null;
    }

    /**
     * Increment affiliate load counter
     */
    private function incrementAffiliateLoad(int $affiliateId): void
    {
        Affiliate::where('id', $affiliateId)->increment('current_load');
    }

    /**
     * Send lead to partner via webhook, email, and dashboard log (Step 8)
     */
    private function sendLeadToPartner(Lead $lead): void
    {
        $affiliate = $lead->routedAffiliate;
        $deliveryLog = [
            'webhook' => null,
            'email' => null,
            'dashboard' => now()->toIso8601String(),
        ];

        // 1. API Webhook delivery
        if ($affiliate && $affiliate->webhook_url) {
            try {
                $response = Http::timeout(10)
                    ->withHeaders([
                        'Authorization' => $affiliate->api_key ? 'Bearer ' . $affiliate->api_key : '',
                        'Content-Type' => 'application/json',
                    ])
                    ->post($affiliate->webhook_url, [
                        'lead_id' => $lead->id,
                        'entity_type' => $lead->entity_type,
                        'business_name' => $lead->business_name,
                        'state_id' => $lead->state_id,
                        'needs_registered_agent' => $lead->needs_registered_agent,
                        'needs_ein' => $lead->needs_ein,
                        'needs_annual_report_assistance' => $lead->needs_annual_report_assistance,
                        'entity_specific_data' => $lead->entity_specific_data,
                        'summary_data' => $lead->summary_data,
                        'submitted_at' => $lead->created_at->toIso8601String(),
                    ]);

                $deliveryLog['webhook'] = [
                    'success' => $response->successful(),
                    'status_code' => $response->status(),
                    'sent_at' => now()->toIso8601String(),
                ];
            } catch (\Exception $e) {
                $deliveryLog['webhook'] = [
                    'success' => false,
                    'error' => $e->getMessage(),
                    'sent_at' => now()->toIso8601String(),
                ];
            }
        }

        // 2. Email delivery
        if ($affiliate && $affiliate->email) {
            try {
                // Queue email with lead details
                $entityTypeLabel = $this->getEntityTypeLabel($lead->entity_type);
                $stateName = $lead->state ? $lead->state->state_name : 'N/A';

                Mail::raw(
                    "New Lead Received\n\n" .
                        "Business: {$lead->business_name}\n" .
                        "Entity Type: {$entityTypeLabel}\n" .
                        "State: {$stateName}\n" .
                        "Registered Agent: " . ($lead->needs_registered_agent ? 'Yes' : 'No') . "\n" .
                        "EIN Needed: " . ($lead->needs_ein ? 'Yes' : 'No') . "\n\n" .
                        "View full details in the dashboard.\n",
                    function ($message) use ($affiliate, $lead) {
                        $message->to($affiliate->email)
                            ->subject("New Lead: {$lead->business_name} - {$lead->entity_type}")
                            ->from(config('mail.from.address'), config('mail.from.name'));
                    }
                );

                $deliveryLog['email'] = [
                    'success' => true,
                    'recipient' => $affiliate->email,
                    'sent_at' => now()->toIso8601String(),
                ];
            } catch (\Exception $e) {
                $deliveryLog['email'] = [
                    'success' => false,
                    'error' => $e->getMessage(),
                    'sent_at' => now()->toIso8601String(),
                ];
            }
        }

        // Update lead
        $lead->update([
            'sent_to_partner' => true,
            'sent_at' => now(),
            'status' => 'sent',
            'delivery_log' => $deliveryLog,
        ]);

        // Clear session
        session()->forget('formation');
    }

    /**
     * Get human-readable entity type label
     */
    private function getEntityTypeLabel(string $type): string
    {
        $labels = [
            'llc' => 'LLC',
            's-corporation' => 'S Corporation',
            'c-corporation' => 'C Corporation',
            'partnership' => 'Partnership',
            'sole-proprietorship' => 'Sole Proprietorship',
            'professional-entity' => 'Professional Entity',
            'foreign-qualification' => 'Foreign Qualification',
        ];

        return $labels[$type] ?? $type;
    }
}
