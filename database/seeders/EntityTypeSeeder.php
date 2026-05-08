<?php

namespace Database\Seeders;

use App\Models\EntityType;
use Illuminate\Database\Seeder;

class EntityTypeSeeder extends Seeder
{
    public function run(): void
    {
        $entityTypes = [
            [
                'name' => 'LLC',
                'slug' => 'llc',
                'description' => 'A Limited Liability Company (LLC) combines the liability protection of a corporation with the tax benefits and flexibility of a partnership. LLC owners (called members) are protected from personal liability for business debts and claims. LLCs offer pass-through taxation, meaning profits are reported on personal tax returns.',
                'seo_title' => 'LLC Formation Guide – Requirements, Costs & Compliance',
                'seo_keywords' => 'LLC, limited liability company, LLC formation, LLC requirements, LLC compliance',
                'seo_description' => 'Complete guide to forming an LLC. Learn about formation requirements, costs, annual compliance, and state-specific filing deadlines.',
                'status' => 1,
            ],
            [
                'name' => 'Corporation',
                'slug' => 'corporation',
                'description' => 'A Corporation (C-Corp) is a separate legal entity owned by shareholders. It offers the strongest protection against personal liability but is subject to double taxation — corporate profits are taxed, and dividends paid to shareholders are taxed again. Corporations have a formal structure with a board of directors, officers, and shareholders.',
                'seo_title' => 'Corporation Formation Guide – Costs, Requirements & Compliance',
                'seo_keywords' => 'corporation, C-Corp, incorporation, corporate formation, business corporation',
                'seo_description' => 'Complete guide to forming a Corporation. Learn about incorporation requirements, costs, board structure, and annual compliance.',
                'status' => 1,
            ],
            [
                'name' => 'S Corporation',
                'slug' => 's-corporation',
                'description' => 'An S Corporation is a special tax election that allows a corporation to pass corporate income, losses, deductions, and credits through to shareholders for federal tax purposes. Shareholders report the income on their personal tax returns, avoiding double taxation. S Corps have restrictions on ownership and stock structure.',
                'seo_title' => 'S Corporation Guide – Election Requirements & Tax Benefits',
                'seo_keywords' => 'S corporation, S-Corp, S Corp election, Subchapter S, S Corp requirements',
                'seo_description' => 'Complete guide to S Corporations. Learn about eligibility requirements, tax benefits, filing deadlines, and how to elect S Corp status.',
                'status' => 1,
            ],
            [
                'name' => 'Nonprofit',
                'slug' => 'nonprofit',
                'description' => 'A Nonprofit organization is formed for charitable, educational, religious, or scientific purposes. Nonprofits can apply for 501(c)(3) tax-exempt status with the IRS, allowing them to receive tax-deductible donations. They must follow strict rules about how funds are used and cannot distribute profits to members or directors.',
                'seo_title' => 'Nonprofit Formation Guide – 501(c)(3) Requirements & Compliance',
                'seo_keywords' => 'nonprofit, 501c3, tax-exempt, charitable organization, nonprofit formation',
                'seo_description' => 'Complete guide to forming a Nonprofit organization. Learn about 501(c)(3) requirements, state registration, board structure, and ongoing compliance.',
                'status' => 1,
            ],
            [
                'name' => 'DBA',
                'slug' => 'dba',
                'description' => 'A DBA (Doing Business As), also known as a fictitious business name, trade name, or assumed name, allows a business to operate under a name different from its legal name. Sole proprietors and partnerships often use DBAs. DBAs do not provide liability protection but allow businesses to brand themselves differently.',
                'seo_title' => 'DBA Guide – Fictitious Business Name Requirements by State',
                'seo_keywords' => 'DBA, doing business as, fictitious business name, trade name, assumed name',
                'seo_description' => 'Complete guide to registering a DBA. Learn about fictitious business name requirements, costs, and renewal rules in each state.',
                'status' => 1,
            ],
            [
                'name' => 'Professional LLC',
                'slug' => 'professional-llc',
                'description' => 'A Professional LLC (PLLC) is a specialized LLC for licensed professionals such as doctors, lawyers, accountants, and architects. PLLCs provide personal liability protection while allowing professionals to practice their licensed trade. Requirements for forming a PLLC vary by state.',
                'seo_title' => 'PLLC Guide – Professional LLC Requirements for Licensed Professionals',
                'seo_keywords' => 'PLLC, professional LLC, professional limited liability company, licensed professionals',
                'seo_description' => 'Complete guide to forming a Professional LLC. Learn about PLLC requirements for doctors, lawyers, accountants, and other licensed professionals.',
                'status' => 1,
            ],
            [
                'name' => 'Limited Partnership',
                'slug' => 'limited-partnership',
                'description' => 'A Limited Partnership (LP) is a partnership consisting of at least one general partner who manages the business and is personally liable, and one or more limited partners who invest capital but have limited liability. LPs are commonly used for real estate investments, film productions, and family businesses.',
                'seo_title' => 'Limited Partnership Guide – Formation, Requirements & Compliance',
                'seo_keywords' => 'limited partnership, LP, partnership formation, general partner, limited partner',
                'seo_description' => 'Complete guide to forming a Limited Partnership. Learn about LP requirements, general vs. limited partner roles, and compliance obligations.',
                'status' => 1,
            ],
            [
                'name' => 'LLP',
                'slug' => 'llp',
                'description' => 'A Limited Liability Partnership (LLP) is a partnership where each partner is protected from personal liability for certain partnership obligations. LLPs are popular among professional service firms such as law firms, accounting firms, and consulting firms. Not all states allow LLPs.',
                'seo_title' => 'LLP Guide – Limited Liability Partnership Requirements & Compliance',
                'seo_keywords' => 'LLP, limited liability partnership, LLP formation, LLP requirements',
                'seo_description' => 'Complete guide to forming an LLP. Learn about LLP requirements, partner liability protection, and state-specific rules.',
                'status' => 1,
            ],
            [
                'name' => 'Sole Proprietorship',
                'slug' => 'sole-proprietorship',
                'description' => 'A Sole Proprietorship is the simplest business structure, owned and operated by one person. There is no legal separation between the owner and the business, meaning the owner is personally liable for all business debts and obligations. Sole proprietors report business income on their personal tax returns.',
                'seo_title' => 'Sole Proprietorship Guide – Requirements, Taxes & Liability',
                'seo_keywords' => 'sole proprietorship, sole proprietor, business registration, self-employment',
                'seo_description' => 'Complete guide to Sole Proprietorships. Learn about registration requirements, tax filing, liability considerations, and when to transition to an LLC.',
                'status' => 1,
            ],
        ];

        foreach ($entityTypes as $type) {
            EntityType::firstOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }
    }
}
