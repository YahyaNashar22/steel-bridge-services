<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('homepage_sections')) {
            return;
        }

        $now = now();

        $defaults = [
            ['key' => 'video_hero', 'title' => 'Your National Integrated Facility Management Partner', 'subtitle' => 'Self-Performing Nationwide 24/7/365 Service', 'content' => 'Steel Bridge delivers scalable, high-standard facilities services with nationwide support and rapid response teams.'],
            ['key' => 'hero_kicker', 'title' => 'Steel Bridge Facilities', 'subtitle' => null, 'content' => null],
            ['key' => 'hero', 'title' => 'Complete Facilities Services', 'subtitle' => 'Maintenance, Operations, Engineering', 'content' => 'Steel Bridge delivers professional facility support, repairs, and maintenance for commercial and industrial spaces.'],
            ['key' => 'hero_primary_cta', 'title' => 'Explore Services', 'subtitle' => null, 'content' => '/services'],
            ['key' => 'hero_secondary_cta', 'title' => 'Request a Callback', 'subtitle' => null, 'content' => '#request-form'],
            ['key' => 'hero_chip_1', 'title' => 'Nationwide Coverage', 'subtitle' => null, 'content' => null],
            ['key' => 'hero_chip_2', 'title' => 'Rapid Response Teams', 'subtitle' => null, 'content' => null],
            ['key' => 'hero_chip_3', 'title' => 'Compliance-Ready Workflows', 'subtitle' => null, 'content' => null],
            ['key' => 'about', 'title' => 'About Steel Bridge', 'subtitle' => 'Experienced Operations Team', 'content' => 'Our specialists provide reliable service delivery with transparent communication and measurable performance.'],
            ['key' => 'hero_highlight_1', 'title' => '2h', 'subtitle' => 'Service Speed', 'content' => 'Priority dispatch response target.'],
            ['key' => 'hero_highlight_2', 'title' => '92%', 'subtitle' => 'Client Retention', 'content' => 'Partnerships renewed year-on-year.'],
            ['key' => 'stats_1', 'title' => '24/7', 'subtitle' => 'Support Availability', 'content' => null],
            ['key' => 'stats_2', 'title' => '98%', 'subtitle' => 'First-Visit Resolution', 'content' => null],
            ['key' => 'stats_3', 'title' => '450+', 'subtitle' => 'Facilities Supported', 'content' => null],
            ['key' => 'stats_4', 'title' => '5+', 'subtitle' => 'Years Experience', 'content' => null],
            ['key' => 'why_us', 'title' => 'Why Choose Us', 'subtitle' => 'Fast, Reliable, Affordable', 'content' => 'We combine technical precision with responsive support and long-term maintenance planning.'],
            ['key' => 'value_one', 'title' => 'Customer Centric', 'subtitle' => 'Core Value', 'content' => 'Every decision is shaped around client outcomes and long-term value.'],
            ['key' => 'value_two', 'title' => 'Operational Excellence', 'subtitle' => 'Core Value', 'content' => 'We execute with discipline, transparency, and measurable standards.'],
            ['key' => 'customer_centric', 'title' => 'Customer-Centric', 'subtitle' => 'Dynamic, Flexible, and Eager to Please.', 'content' => 'We understand our customers situations, perceptions, and expectations. We put their needs first through clear and consistent communication.'],
            ['key' => 'hard_facility', 'title' => 'Hard Facility Management', 'subtitle' => null, 'content' => 'MEP engineering includes planning, designing, and managing mechanical, electrical, and plumbing systems.'],
            ['key' => 'soft_facility', 'title' => 'Soft Facility Management', 'subtitle' => null, 'content' => 'Soft services include planned preventative and corrective support to prevent operational degradation.'],
            ['key' => 'services_preview', 'title' => 'Popular Services', 'subtitle' => 'Built around your comfort', 'content' => null],
            ['key' => 'trusted_brands', 'title' => 'Trusted By', 'subtitle' => null, 'content' => '0'],
            ['key' => 'process', 'title' => 'A delivery model built for uptime and control', 'subtitle' => 'Three clear phases from intake to optimization.', 'content' => 'How We Work'],
            ['key' => 'process_step_1', 'title' => '01 Diagnose', 'subtitle' => null, 'content' => 'On-site or remote assessment with scope clarity and risk mapping.'],
            ['key' => 'process_step_2', 'title' => '02 Deliver', 'subtitle' => null, 'content' => 'Planned execution with live progress updates and quality checks.'],
            ['key' => 'process_step_3', 'title' => '03 Optimize', 'subtitle' => null, 'content' => 'Preventive recommendations and performance reporting.'],
            ['key' => 'industries', 'title' => 'Operational support across high-demand sectors', 'subtitle' => 'Industries We Support', 'content' => "Healthcare\nRetail\nCorporate Offices\nWarehouses\nHospitality\nEducation"],
            ['key' => 'testimonials', 'title' => null, 'subtitle' => null, 'content' => "\"We reduced downtime massively after switching providers.\" | Operations Director\n\"Fast response, clear communication, and very strong execution.\" | Facilities Manager\n\"The reporting quality and follow-up are on another level.\" | Property Lead"],
            ['key' => 'request_cta', 'title' => 'Need Immediate Assistance?', 'subtitle' => 'Request a Visit', 'content' => 'Share your issue details and we will contact you quickly with next steps.'],
            ['key' => 'walkthrough_cta', 'title' => 'Schedule A Walkthrough', 'subtitle' => 'Contact', 'content' => 'Fast response, clear next steps, and a team that understands mission-critical facilities.'],
        ];

        $existingKeys = DB::table('homepage_sections')->pluck('key')->all();

        $missing = collect($defaults)
            ->reject(fn (array $section) => in_array($section['key'], $existingKeys, true))
            ->map(fn (array $section) => [
                ...$section,
                'created_at' => $now,
                'updated_at' => $now,
            ])
            ->values()
            ->all();

        if ($missing !== []) {
            DB::table('homepage_sections')->insert($missing);
        }
    }

    public function down(): void
    {
        // Intentionally left empty to avoid removing live content that may now be in active use.
    }
};
