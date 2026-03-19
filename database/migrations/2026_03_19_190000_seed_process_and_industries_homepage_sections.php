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

        DB::table('homepage_sections')->upsert([
            [
                'key' => 'process',
                'title' => 'A delivery model built for uptime and control',
                'subtitle' => 'Three clear phases from intake to optimization.',
                'content' => 'How We Work',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'process_step_1',
                'title' => '01 Diagnose',
                'subtitle' => null,
                'content' => 'On-site or remote assessment with scope clarity and risk mapping.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'process_step_2',
                'title' => '02 Deliver',
                'subtitle' => null,
                'content' => 'Planned execution with live progress updates and quality checks.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'process_step_3',
                'title' => '03 Optimize',
                'subtitle' => null,
                'content' => 'Preventive recommendations and performance reporting.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'industries',
                'title' => 'Operational support across high-demand sectors',
                'subtitle' => 'Industries We Support',
                'content' => "Healthcare\nRetail\nCorporate Offices\nWarehouses\nHospitality\nEducation",
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ], ['key'], ['title', 'subtitle', 'content', 'updated_at']);
    }

    public function down(): void
    {
        if (! Schema::hasTable('homepage_sections')) {
            return;
        }

        DB::table('homepage_sections')
            ->whereIn('key', ['process', 'process_step_1', 'process_step_2', 'process_step_3', 'industries'])
            ->delete();
    }
};
