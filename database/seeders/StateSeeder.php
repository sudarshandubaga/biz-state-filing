<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $states = [
            ['Alabama', 'alabama', 'Alabama Business Filing', 100, 50, 'fixed', 3, 15, 'Annual', true, 'Alabama Secretary of State', 'https://www.sos.alabama.gov/', null, 'Alabama LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Alabama.'],
            ['Alaska', 'alaska', 'Alaska Business Filing', 250, 100, 'fixed', 1, 2, 'Annual', true, 'Alaska Division of Corporations', 'https://www.commerce.alaska.gov/web/', null, 'Alaska LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Alaska.'],
            ['Arizona', 'arizona', 'Arizona Business Filing', 50, 35, 'fixed', 4, 15, 'Annual', true, 'Arizona Corporation Commission', 'https://ecorp.azcc.gov/', null, 'Arizona LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Arizona.'],
            ['Arkansas', 'arkansas', 'Arkansas Business Filing', 45, 25, 'fixed', 5, 1, 'Annual', true, 'Arkansas Secretary of State', 'https://www.sos.arkansas.gov/', null, 'Arkansas LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Arkansas.'],
            ['California', 'california', 'California Business Filing', 800, 800, 'fixed', 4, 15, 'Annual', true, 'California Secretary of State', 'https://www.sos.ca.gov/', 'https://www.legalzoom.com/llc/california-llc.html', 'California LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in California.'],
            ['Colorado', 'colorado', 'Colorado Business Filing', 50, 50, 'fixed', 3, 31, 'Annual', true, 'Colorado Secretary of State', 'https://www.sos.state.co.us/', null, 'Colorado LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Colorado.'],
            ['Connecticut', 'connecticut', 'Connecticut Business Filing', 120, 50, 'fixed', 3, 31, 'Annual', true, 'Connecticut Secretary of State', 'https://portal.ct.gov/SOTS', null, 'Connecticut LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Connecticut.'],
            ['Delaware', 'delaware', 'Delaware Business Filing', 300, 200, 'fixed', 3, 1, 'Annual', true, 'Delaware Division of Corporations', 'https://corp.delaware.gov/', 'https://www.legalzoom.com/llc/delaware-llc.html', 'Delaware LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Delaware.'],
            ['Florida', 'florida', 'Florida Business Filing', 125, 50, 'fixed', 5, 1, 'Annual', true, 'Florida Division of Corporations', 'https://dos.myflorida.com/sunbiz/', null, 'Florida LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Florida.'],
            ['Georgia', 'georgia', 'Georgia Business Filing', 100, 50, 'fixed', 4, 1, 'Annual', true, 'Georgia Secretary of State', 'https://sos.ga.gov/', null, 'Georgia LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Georgia.'],
            ['Hawaii', 'hawaii', 'Hawaii Business Filing', 50, 15, 'fixed', 3, 31, 'Annual', true, 'Hawaii Department of Commerce', 'https://cca.hawaii.gov/breg/', null, 'Hawaii LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Hawaii.'],
            ['Idaho', 'idaho', 'Idaho Business Filing', 100, 30, 'fixed', 4, 15, 'Annual', true, 'Idaho Secretary of State', 'https://sos.idaho.gov/', null, 'Idaho LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Idaho.'],
            ['Illinois', 'illinois', 'Illinois Business Filing', 150, 75, 'fixed', 3, 1, 'Annual', true, 'Illinois Secretary of State', 'https://www.ilsos.gov/', null, 'Illinois LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Illinois.'],
            ['Indiana', 'indiana', 'Indiana Business Filing', 100, 50, 'fixed', 4, 15, 'Annual', true, 'Indiana Secretary of State', 'https://www.in.gov/sos/', null, 'Indiana LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Indiana.'],
            ['Iowa', 'iowa', 'Iowa Business Filing', 50, 30, 'fixed', 4, 1, 'Annual', true, 'Iowa Secretary of State', 'https://sos.iowa.gov/', null, 'Iowa LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Iowa.'],
            ['Kansas', 'kansas', 'Kansas Business Filing', 165, 60, 'fixed', 4, 15, 'Annual', true, 'Kansas Secretary of State', 'https://www.sos.ks.gov/', null, 'Kansas LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Kansas.'],
            ['Kentucky', 'kentucky', 'Kentucky Business Filing', 40, 15, 'fixed', 6, 30, 'Annual', true, 'Kentucky Secretary of State', 'https://www.sos.ky.gov/', null, 'Kentucky LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Kentucky.'],
            ['Louisiana', 'louisiana', 'Louisiana Business Filing', 100, 50, 'fixed', 5, 1, 'Annual', true, 'Louisiana Secretary of State', 'https://www.sos.la.gov/', null, 'Louisiana LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Louisiana.'],
            ['Maine', 'maine', 'Maine Business Filing', 175, 85, 'fixed', 6, 1, 'Annual', true, 'Maine Secretary of State', 'https://www.maine.gov/sos/', null, 'Maine LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Maine.'],
            ['Maryland', 'maryland', 'Maryland Business Filing', 100, 300, 'fixed', 4, 15, 'Annual', true, 'Maryland Department of Assessments', 'https://sdat.dat.maryland.gov/', null, 'Maryland LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Maryland.'],
            ['Massachusetts', 'massachusetts', 'Massachusetts Business Filing', 500, 100, 'fixed', 3, 15, 'Annual', true, 'Massachusetts Secretary of State', 'https://www.sec.state.ma.us/', null, 'Massachusetts LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Massachusetts.'],
            ['Michigan', 'michigan', 'Michigan Business Filing', 50, 25, 'fixed', 2, 15, 'Annual', true, 'Michigan Department of Licensing', 'https://www.michigan.gov/lara', null, 'Michigan LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Michigan.'],
            ['Minnesota', 'minnesota', 'Minnesota Business Filing', 155, 50, 'fixed', 12, 31, 'Annual', true, 'Minnesota Secretary of State', 'https://www.sos.state.mn.us/', null, 'Minnesota LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Minnesota.'],
            ['Mississippi', 'mississippi', 'Mississippi Business Filing', 50, 25, 'fixed', 4, 15, 'Annual', true, 'Mississippi Secretary of State', 'https://www.sos.ms.gov/', null, 'Mississippi LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Mississippi.'],
            ['Missouri', 'missouri', 'Missouri Business Filing', 50, 50, 'fixed', 4, 15, 'Annual', true, 'Missouri Secretary of State', 'https://www.sos.mo.gov/', null, 'Missouri LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Missouri.'],
            ['Montana', 'montana', 'Montana Business Filing', 70, 10, 'fixed', 4, 15, 'Annual', true, 'Montana Secretary of State', 'https://sosmt.gov/', null, 'Montana LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Montana.'],
            ['Nebraska', 'nebraska', 'Nebraska Business Filing', 100, 45, 'fixed', 4, 15, 'Annual', true, 'Nebraska Secretary of State', 'https://www.sos.nebraska.gov/', null, 'Nebraska LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Nebraska.'],
            ['Nevada', 'nevada', 'Nevada Business Filing', 425, 200, 'fixed', 1, 1, 'Annual', true, 'Nevada Secretary of State', 'https://www.nvsos.gov/', 'https://www.legalzoom.com/llc/nevada-llc.html', 'Nevada LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Nevada.'],
            ['New Hampshire', 'new-hampshire', 'New Hampshire Business Filing', 100, 50, 'fixed', 4, 1, 'Annual', true, 'New Hampshire Secretary of State', 'https://www.sos.nh.gov/', null, 'New Hampshire LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in New Hampshire.'],
            ['New Jersey', 'new-jersey', 'New Jersey Business Filing', 125, 75, 'fixed', 4, 15, 'Annual', true, 'New Jersey Division of Revenue', 'https://www.nj.gov/treasury/revenue/', null, 'New Jersey LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in New Jersey.'],
            ['New Mexico', 'new-mexico', 'New Mexico Business Filing', 50, 0, 'fixed', 4, 15, 'Annual', false, 'New Mexico Secretary of State', 'https://www.sos.state.nm.us/', null, 'New Mexico LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in New Mexico.'],
            ['New York', 'new-york', 'New York Business Filing', 200, 50, 'fixed', 12, 31, 'Biennial', true, 'New York Department of State', 'https://www.dos.ny.gov/', 'https://www.legalzoom.com/llc/new-york-llc.html', 'New York LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in New York.'],
            ['North Carolina', 'north-carolina', 'North Carolina Business Filing', 125, 200, 'fixed', 4, 15, 'Annual', true, 'North Carolina Secretary of State', 'https://www.sosnc.gov/', null, 'North Carolina LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in North Carolina.'],
            ['North Dakota', 'north-dakota', 'North Dakota Business Filing', 135, 50, 'fixed', 5, 1, 'Annual', true, 'North Dakota Secretary of State', 'https://www.sos.nd.gov/', null, 'North Dakota LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in North Dakota.'],
            ['Ohio', 'ohio', 'Ohio Business Filing', 99, 50, 'fixed', 3, 31, 'Annual', true, 'Ohio Secretary of State', 'https://www.sos.state.oh.us/', null, 'Ohio LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Ohio.'],
            ['Oklahoma', 'oklahoma', 'Oklahoma Business Filing', 100, 25, 'fixed', 7, 1, 'Annual', true, 'Oklahoma Secretary of State', 'https://www.sos.ok.gov/', null, 'Oklahoma LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Oklahoma.'],
            ['Oregon', 'oregon', 'Oregon Business Filing', 100, 100, 'fixed', 3, 31, 'Annual', true, 'Oregon Secretary of State', 'https://sos.oregon.gov/', null, 'Oregon LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Oregon.'],
            ['Pennsylvania', 'pennsylvania', 'Pennsylvania Business Filing', 125, 75, 'fixed', 4, 15, 'Annual', true, 'Pennsylvania Department of State', 'https://www.dos.pa.gov/', null, 'Pennsylvania LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Pennsylvania.'],
            ['Rhode Island', 'rhode-island', 'Rhode Island Business Filing', 150, 50, 'fixed', 5, 1, 'Annual', true, 'Rhode Island Secretary of State', 'https://www.sos.ri.gov/', null, 'Rhode Island LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Rhode Island.'],
            ['South Carolina', 'south-carolina', 'South Carolina Business Filing', 110, 50, 'fixed', 4, 15, 'Annual', true, 'South Carolina Secretary of State', 'https://www.scsos.com/', null, 'South Carolina LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in South Carolina.'],
            ['South Dakota', 'south-dakota', 'South Dakota Business Filing', 150, 50, 'fixed', 5, 1, 'Annual', true, 'South Dakota Secretary of State', 'https://sdsos.gov/', null, 'South Dakota LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in South Dakota.'],
            ['Tennessee', 'tennessee', 'Tennessee Business Filing', 300, 50, 'fixed', 4, 1, 'Annual', true, 'Tennessee Secretary of State', 'https://sos.tn.gov/', null, 'Tennessee LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Tennessee.'],
            ['Texas', 'texas', 'Texas Business Filing', 300, 50, 'fixed', 5, 15, 'Annual', true, 'Texas Secretary of State', 'https://www.sos.state.tx.us/', 'https://www.legalzoom.com/llc/texas-llc.html', 'Texas LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Texas.'],
            ['Utah', 'utah', 'Utah Business Filing', 54, 20, 'fixed', 4, 15, 'Annual', true, 'Utah Division of Corporations', 'https://corporations.utah.gov/', null, 'Utah LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Utah.'],
            ['Vermont', 'vermont', 'Vermont Business Filing', 125, 35, 'fixed', 3, 31, 'Annual', true, 'Vermont Secretary of State', 'https://www.sec.state.vt.us/', null, 'Vermont LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Vermont.'],
            ['Virginia', 'virginia', 'Virginia Business Filing', 100, 50, 'fixed', 3, 15, 'Annual', true, 'Virginia State Corporation Commission', 'https://www.scc.virginia.gov/', null, 'Virginia LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Virginia.'],
            ['Washington', 'washington', 'Washington Business Filing', 200, 60, 'fixed', 12, 31, 'Annual', true, 'Washington Secretary of State', 'https://www.sos.wa.gov/', null, 'Washington LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Washington.'],
            ['West Virginia', 'west-virginia', 'West Virginia Business Filing', 50, 25, 'fixed', 7, 1, 'Annual', true, 'West Virginia Secretary of State', 'https://www.sos.wv.gov/', null, 'West Virginia LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in West Virginia.'],
            ['Wisconsin', 'wisconsin', 'Wisconsin Business Filing', 130, 25, 'fixed', 3, 31, 'Annual', true, 'Wisconsin Department of Financial Institutions', 'https://www.wdfi.org/', null, 'Wisconsin LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Wisconsin.'],
            ['Wyoming', 'wyoming', 'Wyoming Business Filing', 100, 50, 'fixed', 2, 1, 'Annual', true, 'Wyoming Secretary of State', 'https://sos.wyo.gov/', 'https://www.legalzoom.com/llc/wyoming-llc.html', 'Wyoming LLC Formation – Business Filing Deadlines & Requirements', 'Complete guide to forming and maintaining an LLC in Wyoming.'],
        ];

        $countryId = 1;

        foreach ($states as $state) {
            State::firstOrCreate(
                ['state_slug' => $state[1]],
                [
                    'country_id' => $countryId,
                    'state_name' => $state[0],
                    'state_slug' => $state[1],
                    'filing_name' => $state[2],
                    'filing_fee' => $state[3],
                    'late_fee' => $state[4],
                    'deadline_type' => $state[5],
                    'deadline_month' => $state[6],
                    'deadline_day' => $state[7],
                    'renewal_cycle' => $state[8],
                    'report_required' => $state[9],
                    'compliance_agency' => $state[10],
                    'portal_url' => $state[11],
                    'affiliate_url' => $state[12],
                    'seo_title' => $state[13],
                    'seo_description' => $state[14],
                    'status' => 1,
                ]
            );
        }
    }
}
