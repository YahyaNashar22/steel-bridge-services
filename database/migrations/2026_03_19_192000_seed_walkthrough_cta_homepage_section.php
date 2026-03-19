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
                'key' => 'walkthrough_cta',
                'title' => 'Schedule A Walkthrough',
                'subtitle' => 'Contact',
                'content' => 'Fast response, clear next steps, and a team that understands mission-critical facilities.',
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
            ->where('key', 'walkthrough_cta')
            ->delete();
    }
};
