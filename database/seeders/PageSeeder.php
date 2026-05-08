<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'short_summary' => 'Learn more about our company, mission, and values.',
                'long_description' => '<h2>Our Story</h2><p>We are a leading business state filing service provider dedicated to helping entrepreneurs and businesses navigate the complexities of state compliance. With years of experience in the industry, we have helped thousands of businesses get started and stay compliant.</p><h2>Our Mission</h2><p>Our mission is to simplify business state filing processes and make it easy for anyone to start and manage their business with confidence.</p><h2>Our Values</h2><ul><li><strong>Integrity:</strong> We operate with transparency and honesty in all our dealings.</li><li><strong>Excellence:</strong> We strive for the highest quality in every service we provide.</li><li><strong>Customer Focus:</strong> Our customers are at the heart of everything we do.</li><li><strong>Innovation:</strong> We continuously improve our processes to serve you better.</li></ul>',
                'image' => null,
                'seo_title' => 'About Us - BizStateFiling',
                'seo_keywords' => 'about us, company, mission, business filing, state compliance',
                'seo_description' => 'Learn about BizStateFiling - our mission, values, and commitment to helping businesses with state filing and compliance.',
                'canonical_url' => null,
                'template' => 'default',
                'status' => true,
            ],
            [
                'title' => 'Affiliate Disclosure',
                'slug' => 'affiliate-disclosure',
                'short_summary' => 'Our affiliate relationship disclosure and transparency policy.',
                'long_description' => '<h2>Affiliate Disclosure</h2><p>BizStateFiling is committed to transparency and honesty with our users. This Affiliate Disclosure explains how we may earn commissions through affiliate relationships.</p><h3>What Are Affiliate Links?</h3><p>Some of the links on our website are affiliate links. This means that if you click on these links and make a purchase or take a specific action, we may earn a commission at no additional cost to you.</p><h3>Our Commitment</h3><p>We only recommend products and services that we believe will add value to our users. Our recommendations are based on our research and experience, not solely on commission potential.</p><h3>Transparency</h3><p>We strive to clearly identify affiliate links when used. However, if you have any questions about our affiliate relationships, please contact us.</p>',
                'image' => null,
                'seo_title' => 'Affiliate Disclosure - BizStateFiling',
                'seo_keywords' => 'affiliate disclosure, affiliate links, commission, transparency',
                'seo_description' => 'Read our affiliate disclosure policy. Learn about how we may earn commissions through affiliate relationships while maintaining transparency.',
                'canonical_url' => null,
                'template' => 'default',
                'status' => true,
            ],
            [
                'title' => 'Help Center',
                'slug' => 'help-center',
                'short_summary' => 'Find answers to frequently asked questions and get support.',
                'long_description' => '<h2>Help Center</h2><p>Welcome to our Help Center. Here you will find answers to commonly asked questions and resources to help you with our services.</p><h3>Frequently Asked Questions</h3><h4>How do I start a business filing?</h4><p>Simply select your state and entity type from our website, fill in the required information, and we will guide you through the process step by step.</p><h4>How long does the filing process take?</h4><p>Processing times vary by state. Typically, online filings are processed within 1-3 business days, while mail filings may take 2-4 weeks.</p><h4>What documents do I need?</h4><p>Requirements vary by state and entity type. Our system will inform you of all necessary documents when you begin the filing process.</p><h3>Contact Support</h3><p>If you cannot find the answer you are looking for, please reach out to our support team and we will be happy to assist you.</p>',
                'image' => null,
                'seo_title' => 'Help Center - BizStateFiling',
                'seo_keywords' => 'help center, FAQ, support, business filing help, customer support',
                'seo_description' => 'Visit our Help Center for answers to frequently asked questions about business state filing, entity types, and compliance requirements.',
                'canonical_url' => null,
                'template' => 'default',
                'status' => true,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'short_summary' => 'How we collect, use, and protect your personal information.',
                'long_description' => '<h2>Privacy Policy</h2><p>Last updated: ' . date('F d, Y') . '</p><p>BizStateFiling ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website.</p><h3>Information We Collect</h3><p>We may collect personal information that you voluntarily provide to us when you use our services, including your name, email address, phone number, and business information.</p><h3>How We Use Your Information</h3><p>We use the information we collect to provide and improve our services, process transactions, communicate with you, and comply with legal obligations.</p><h3>Data Protection</h3><p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p><h3>Third-Party Disclosure</h3><p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as required by law.</p><h3>Your Rights</h3><p>You have the right to access, update, or delete your personal information. Contact us to exercise these rights.</p>',
                'image' => null,
                'seo_title' => 'Privacy Policy - BizStateFiling',
                'seo_keywords' => 'privacy policy, data protection, privacy, personal information',
                'seo_description' => 'Read our Privacy Policy to understand how we collect, use, and protect your personal information when using our services.',
                'canonical_url' => null,
                'template' => 'default',
                'status' => true,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'short_summary' => 'Terms and conditions governing the use of our services.',
                'long_description' => '<h2>Terms & Conditions</h2><p>Last updated: ' . date('F d, Y') . '</p><p>Please read these Terms & Conditions ("Terms") carefully before using our website and services.</p><h3>Acceptance of Terms</h3><p>By accessing or using our services, you agree to be bound by these Terms. If you do not agree, please do not use our services.</p><h3>Services Description</h3><p>BizStateFiling provides business state filing assistance and compliance information. We assist with preparing and filing documents with state authorities.</p><h3>User Responsibilities</h3><p>You agree to provide accurate and complete information when using our services. You are responsible for maintaining the confidentiality of your account.</p><h3>Limitation of Liability</h3><p>We strive to provide accurate information and services, but we cannot guarantee results. Our liability is limited to the extent permitted by law.</p><h3>Changes to Terms</h3><p>We reserve the right to modify these Terms at any time. Changes will be effective immediately upon posting.</p>',
                'image' => null,
                'seo_title' => 'Terms & Conditions - BizStateFiling',
                'seo_keywords' => 'terms and conditions, terms of service, legal, business filing terms',
                'seo_description' => 'Review our Terms & Conditions governing the use of our business state filing services and website.',
                'canonical_url' => null,
                'template' => 'default',
                'status' => true,
            ],
            [
                'title' => 'Disclaimer',
                'slug' => 'disclaimer',
                'short_summary' => 'Important disclaimers regarding our services and information.',
                'long_description' => '<h2>Disclaimer</h2><p>The information provided on BizStateFiling is for general informational purposes only.</p><h3>No Legal Advice</h3><p>The content on this website is not intended to be a substitute for professional legal advice. We strongly recommend consulting with a qualified attorney for advice regarding your specific situation.</p><h3>Accuracy of Information</h3><p>While we strive to keep the information on our website accurate and up-to-date, we make no representations or warranties of any kind about the completeness, accuracy, or availability of the information.</p><h3>Third-Party Links</h3><p>Our website may contain links to third-party websites. We have no control over the content or practices of these sites and assume no responsibility for them.</p><h3>Limitation of Liability</h3><p>BizStateFiling shall not be liable for any loss or damage arising from the use of our website or services.</p>',
                'image' => null,
                'seo_title' => 'Disclaimer - BizStateFiling',
                'seo_keywords' => 'disclaimer, legal disclaimer, no legal advice, terms',
                'seo_description' => 'Read our Disclaimer regarding the use of information and services provided on BizStateFiling.',
                'canonical_url' => null,
                'template' => 'default',
                'status' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }

        $this->command->info(count($pages) . ' pages seeded successfully.');
    }
}