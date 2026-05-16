<?php

namespace Database\Seeders;

use App\Models\TaxForm;
use App\Models\State;
use Illuminate\Database\Seeder;

class TaxFormSeeder extends Seeder
{
    public function run(): void
    {
        $states = State::whereIn('state_name', ['Michigan', 'Arizona', 'Arkansas', 'Texas', 'California'])->get()->keyBy('state_name');

        $forms = [
            [
                'form_name' => 'Articles of Organization',
                'form_number' => 'CSCL/CD-700',
                'description' => 'Official Articles of Organization for Michigan Domestic Limited Liability Companies.',
                'category' => 'formation',
                'state_id' => $states['Michigan']->id ?? null,
                'entity_type' => 'LLC',
                'download_url' => '#',
                'is_official' => true,
            ],
            [
                'form_name' => 'Corp Annual Report',
                'form_number' => 'AZCC-AR',
                'description' => 'Mandatory annual maintenance filing for Corporations in Arizona.',
                'category' => 'compliance',
                'state_id' => $states['Arizona']->id ?? null,
                'entity_type' => 'Corporation',
                'download_url' => '#',
                'is_official' => true,
            ],
            [
                'form_name' => 'Form SS-4 (EIN)',
                'form_number' => 'SS-4',
                'description' => 'Official IRS Application for Employer Identification Number.',
                'category' => 'tax',
                'state_id' => null, // Federal
                'entity_type' => 'all',
                'download_url' => 'https://www.irs.gov/pub/irs-pdf/fss4.pdf',
                'is_official' => true,
                'official_url' => 'https://www.irs.gov/forms-pubs/about-form-ss-4',
            ],
            [
                'form_name' => 'Franchise Tax Renewal',
                'form_number' => 'AR-SOS-FT',
                'description' => 'Arkansas Secretary of State franchise tax renewal form.',
                'category' => 'tax',
                'state_id' => $states['Arkansas']->id ?? null,
                'entity_type' => 'all',
                'download_url' => '#',
                'is_official' => true,
            ],
            [
                'form_name' => 'Statement of Information',
                'form_number' => 'LLC-12',
                'description' => 'California LLC Statement of Information filing.',
                'category' => 'compliance',
                'state_id' => $states['California']->id ?? null,
                'entity_type' => 'LLC',
                'download_url' => '#',
                'is_official' => true,
            ],
        ];

        foreach ($forms as $form) {
            TaxForm::create($form);
        }
    }
}
