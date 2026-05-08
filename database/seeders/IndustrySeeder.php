<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $industries = [
            [
                'name' => 'Restaurant',
                'slug' => 'restaurant-business',
                'description' => 'The restaurant industry requires specific health permits, liquor licenses, food handler certifications, and business licenses that vary by state and locality. From food trucks to fine dining, each type of food service business has unique compliance requirements including health department inspections, food safety certifications, and zoning approvals.',
                'short_description' => 'Health permits, liquor licenses, food handler certifications, and business licenses for restaurants.',
                'seo_title' => 'Restaurant Business Requirements – Licenses, Permits & Compliance',
                'seo_keywords' => 'restaurant business license, food service permit, liquor license, health department permit',
                'seo_description' => 'Complete guide to restaurant business licenses and permits. Learn about health permits, liquor licenses, food handler certifications, and compliance.',
                'status' => 1,
            ],
            [
                'name' => 'Trucking',
                'slug' => 'trucking-business',
                'description' => 'The trucking and transportation industry is heavily regulated at both federal and state levels. Requirements include USDOT numbers, MC authority, commercial driver\'s licenses (CDL), FMCSA compliance, vehicle registrations, and insurance. Each state may have additional requirements for intrastate operations.',
                'short_description' => 'USDOT numbers, MC authority, CDL requirements, FMCSA compliance, and insurance for trucking.',
                'seo_title' => 'Trucking Business Requirements – DOT, FMCSA & State Compliance',
                'seo_keywords' => 'trucking business license, USDOT number, MC authority, CDL requirements, FMCSA compliance',
                'seo_description' => 'Complete guide to starting a trucking business. Learn about USDOT numbers, MC authority, CDL requirements, and FMCSA compliance.',
                'status' => 1,
            ],
            [
                'name' => 'Real Estate',
                'slug' => 'real-estate-business',
                'description' => 'The real estate industry encompasses agents, brokers, property managers, appraisers, and real estate investment companies. Requirements include state real estate licenses, broker licenses, property management permits, and continuing education. Each state has a real estate commission that oversees licensing and compliance.',
                'short_description' => 'Real estate licenses, broker licenses, property management permits, and continuing education.',
                'seo_title' => 'Real Estate Business Requirements – Licenses, Permits & Compliance',
                'seo_keywords' => 'real estate license, broker license, property management permit, real estate commission',
                'seo_description' => 'Complete guide to real estate business licenses. Learn about agent and broker licensing, property management permits, and state requirements.',
                'status' => 1,
            ],
            [
                'name' => 'Cleaning',
                'slug' => 'cleaning-business',
                'description' => 'The cleaning industry includes residential cleaning, commercial janitorial services, carpet cleaning, and specialized cleaning services. Requirements typically include general business licenses, bonds, insurance, and sometimes specific certifications for handling cleaning chemicals. Some states require specific permits for certain types of cleaning services.',
                'short_description' => 'Business licenses, bonds, insurance, and certifications for cleaning service businesses.',
                'seo_title' => 'Cleaning Business Requirements – Licenses, Bonds & Insurance',
                'seo_keywords' => 'cleaning business license, janitorial license, cleaning service bond, cleaning insurance',
                'seo_description' => 'Complete guide to starting a cleaning business. Learn about licensing, bonding, insurance requirements, and certifications.',
                'status' => 1,
            ],
            [
                'name' => 'Construction',
                'slug' => 'construction-business',
                'description' => 'The construction industry requires contractor licenses, building permits, bonds, insurance, and worker\'s compensation coverage. Requirements vary significantly by state and by trade (general contractor, electrical, plumbing, HVAC). Many states require passing trade exams and demonstrating financial responsibility.',
                'short_description' => 'Contractor licenses, building permits, bonds, insurance, and trade-specific certifications.',
                'seo_title' => 'Construction Business Requirements – Contractor Licenses & Permits',
                'seo_keywords' => 'contractor license, construction permit, builders license, trade license, contractor bond',
                'seo_description' => 'Complete guide to construction business licensing. Learn about contractor licenses, building permits, bonds, and insurance requirements.',
                'status' => 1,
            ],
            [
                'name' => 'E-commerce',
                'slug' => 'ecommerce-business',
                'description' => 'E-commerce businesses need to consider sales tax collection, business licenses, seller permits, and online business regulations. Requirements include registering for sales tax in states where you have nexus, obtaining reseller certificates, and complying with consumer protection laws. Some states require specific online seller permits.',
                'short_description' => 'Sales tax registration, seller permits, reseller certificates, and online business compliance.',
                'seo_title' => 'E-commerce Business Requirements – Sales Tax & Online Seller Permits',
                'seo_keywords' => 'ecommerce license, sales tax permit, seller permit, reseller certificate, online business license',
                'seo_description' => 'Complete guide to e-commerce business licensing. Learn about sales tax collection, seller permits, reseller certificates, and online compliance.',
                'status' => 1,
            ],
            [
                'name' => 'Healthcare',
                'slug' => 'healthcare-business',
                'description' => 'Healthcare businesses including medical practices, clinics, dental offices, and home health agencies require extensive licensing and regulatory compliance. Requirements include professional medical licenses, facility licenses, Medicare/Medicaid enrollment, HIPAA compliance, and malpractice insurance.',
                'short_description' => 'Medical licenses, facility permits, HIPAA compliance, Medicare enrollment, and insurance.',
                'seo_title' => 'Healthcare Business Requirements – Medical Licenses & Compliance',
                'seo_keywords' => 'healthcare license, medical practice license, HIPAA compliance, Medicare enrollment',
                'seo_description' => 'Complete guide to healthcare business licensing. Learn about medical licenses, facility permits, HIPAA compliance, and regulatory requirements.',
                'status' => 1,
            ],
            [
                'name' => 'Salon & Beauty',
                'slug' => 'salon-beauty-business',
                'description' => 'Salon and beauty businesses including hair salons, barbershops, nail salons, and spas require cosmetology licenses, salon establishment permits, health inspections, and sanitation certifications. Requirements vary by state cosmetology boards and include both individual practitioner licenses and establishment permits.',
                'short_description' => 'Cosmetology licenses, salon permits, health inspections, and sanitation certifications.',
                'seo_title' => 'Salon & Beauty Business Requirements – Cosmetology Licenses & Permits',
                'seo_keywords' => 'salon license, cosmetology license, barber license, beauty business permit, salon inspection',
                'seo_description' => 'Complete guide to salon and beauty business licensing. Learn about cosmetology licenses, salon permits, health inspections, and certifications.',
                'status' => 1,
            ],
            [
                'name' => 'Child Care',
                'slug' => 'child-care-business',
                'description' => 'Child care businesses including daycare centers, preschools, and in-home child care require state licensing, background checks, health and safety inspections, staff-to-child ratio compliance, and training certifications. Each state has a department of social services or similar agency that regulates child care facilities.',
                'short_description' => 'Daycare licenses, background checks, health inspections, and staff certification requirements.',
                'seo_title' => 'Child Care Business Requirements – Daycare Licenses & Compliance',
                'seo_keywords' => 'daycare license, child care permit, preschool license, childcare certification, background check',
                'seo_description' => 'Complete guide to child care business licensing. Learn about daycare licenses, background checks, health inspections, and staff requirements.',
                'status' => 1,
            ],
            [
                'name' => 'Landscaping',
                'slug' => 'landscaping-business',
                'description' => 'Landscaping businesses require general business licenses, contractor licenses in some states, pesticide applicator licenses, and environmental permits. Requirements vary based on services offered such as lawn care, tree removal, irrigation installation, and pesticide application.',
                'short_description' => 'Business licenses, contractor licenses, pesticide applicator permits, and environmental compliance.',
                'seo_title' => 'Landscaping Business Requirements – Licenses & Permits Guide',
                'seo_keywords' => 'landscaping license, lawn care license, pesticide applicator license, landscaping contractor',
                'seo_description' => 'Complete guide to landscaping business licensing. Learn about contractor licenses, pesticide permits, and environmental compliance requirements.',
                'status' => 1,
            ],
            [
                'name' => 'Photography',
                'slug' => 'photography-business',
                'description' => 'Photography businesses need general business licenses, and in some cases, sales tax permits for selling prints and digital files. Wedding photographers, real estate photographers, and commercial photographers may need specific permits for shooting at certain locations. Some states require photography business registration.',
                'short_description' => 'Business licenses, sales tax permits, location permits, and photography business registration.',
                'seo_title' => 'Photography Business Requirements – Licenses & Permits Guide',
                'seo_keywords' => 'photography license, photographer permit, photography business registration, sales tax for photographers',
                'seo_description' => 'Complete guide to photography business licensing. Learn about business licenses, sales tax permits, and location shooting permits.',
                'status' => 1,
            ],
            [
                'name' => 'Consulting',
                'slug' => 'consulting-business',
                'description' => 'Consulting businesses typically need general business licenses and may require professional certifications depending on the field. Management consultants, IT consultants, and business consultants usually operate with standard business registrations. However, some consulting fields like financial or legal consulting have additional licensing requirements.',
                'short_description' => 'Business licenses, professional certifications, and consulting business registration.',
                'seo_title' => 'Consulting Business Requirements – Licenses & Certifications Guide',
                'seo_keywords' => 'consulting license, consultant certification, business consultant registration, consulting permits',
                'seo_description' => 'Complete guide to consulting business licensing. Learn about business licenses, professional certifications, and registration requirements.',
                'status' => 1,
            ],
        ];

        foreach ($industries as $industry) {
            Industry::firstOrCreate(
                ['slug' => $industry['slug']],
                $industry
            );
        }
    }
}
