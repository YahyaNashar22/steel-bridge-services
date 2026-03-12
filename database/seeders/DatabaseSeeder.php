<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        Setting::query()->upsert([
            ['key' => 'company_phone', 'value' => '+1 (555) 123-4567'],
            ['key' => 'company_email', 'value' => 'info@steelbridge.com'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/steelbridge'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/steelbridge'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/steelbridge'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@steelbridge'],
            ['key' => 'terms_page_title', 'value' => 'Terms and Conditions'],
            ['key' => 'terms_page_intro', 'value' => 'Please review the terms governing the use of Steel Bridge Services and this website.'],
            ['key' => 'terms_page_content', 'value' => "By accessing this website, you agree to use it only for lawful purposes.\n\nSteel Bridge Services may update these terms at any time without prior notice.\n\nUsers are responsible for ensuring any information they submit is accurate and does not violate third-party rights."],
            ['key' => 'copyright_title', 'value' => 'Copyright Notice'],
            ['key' => 'copyright_content', 'value' => "All website content, branding, copy, graphics, and other materials are owned by Steel Bridge Services unless otherwise stated.\n\nNo part of this website may be reproduced, distributed, or reused without prior written permission."],
        ], ['key'], ['value']);

        HomepageSection::query()->upsert([
            ['key' => 'hero', 'title' => 'Complete Facilities Services', 'subtitle' => 'Maintenance, Operations, Engineering', 'content' => 'Steel Bridge delivers professional facility support, repairs, and maintenance for commercial and industrial spaces.'],
            ['key' => 'video_hero', 'title' => 'Your National Integrated Facility Management Partner', 'subtitle' => 'Self-Performing Nationwide 24/7/365 Service', 'content' => 'Steel Bridge delivers scalable, high-standard facilities services with nationwide support and rapid response teams.'],
            ['key' => 'about', 'title' => 'About Steel Bridge', 'subtitle' => 'Experienced Operations Team', 'content' => 'Our specialists provide reliable service delivery with transparent communication and measurable performance.'],
            ['key' => 'why_us', 'title' => 'Why Choose Us', 'subtitle' => 'Fast, Reliable, Affordable', 'content' => 'We combine technical precision with responsive support and long-term maintenance planning.'],
            ['key' => 'customer_centric', 'title' => 'Customer-Centric', 'subtitle' => 'Dynamic, Flexible, and Eager to Please.', 'content' => 'We understand our customers situations, perceptions, and expectations. We put their needs first through clear and consistent communication.'],
            ['key' => 'hard_facility', 'title' => 'Hard Facility Management', 'subtitle' => null, 'content' => 'MEP engineering includes planning, designing, and managing mechanical, electrical, and plumbing systems.'],
            ['key' => 'soft_facility', 'title' => 'Soft Facility Management', 'subtitle' => null, 'content' => 'Soft services include planned preventative and corrective support to prevent operational degradation.'],
            ['key' => 'value_one', 'title' => 'Customer Centric', 'subtitle' => null, 'content' => 'Every decision is shaped around client outcomes and long-term value.'],
            ['key' => 'value_two', 'title' => 'Operational Excellence', 'subtitle' => null, 'content' => 'We execute with discipline, transparency, and measurable standards.'],
            ['key' => 'services_preview', 'title' => 'Popular Services', 'subtitle' => 'Built around your comfort', 'content' => null],
            ['key' => 'request_cta', 'title' => 'Need Immediate Assistance?', 'subtitle' => 'Request a Visit', 'content' => 'Share your issue details and we will contact you quickly with next steps.'],
        ], ['key'], ['title', 'subtitle', 'content']);

        $installation = ServiceCategory::query()->updateOrCreate([
            'slug' => 'installation',
        ], [
            'name' => 'Installation',
        ]);

        $maintenance = ServiceCategory::query()->updateOrCreate([
            'slug' => 'maintenance',
        ], [
            'name' => 'Maintenance',
        ]);

        Service::query()->updateOrCreate([
            'slug' => 'hvac-system-installation',
        ], [
            'service_category_id' => $installation->id,
            'title' => 'Mechanical Systems Installation',
            'short_description' => 'Complete installation of heating and cooling systems for homes and offices.',
            'long_description' => 'We assess your space, recommend the right system size, and install it according to safety and performance standards.',
            'is_published' => true,
        ]);

        Service::query()->updateOrCreate([
            'slug' => 'seasonal-hvac-maintenance',
        ], [
            'service_category_id' => $maintenance->id,
            'title' => 'Planned Preventive Maintenance',
            'short_description' => 'Preventive checkups to maximize performance and reduce breakdowns.',
            'long_description' => 'Our maintenance package includes filter checks, refrigerant verification, thermostat calibration, and full system diagnostics.',
            'is_published' => true,
        ]);

    }
}
