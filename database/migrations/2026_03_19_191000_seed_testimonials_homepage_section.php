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
                'key' => 'testimonials',
                'title' => null,
                'subtitle' => null,
                'content' => "\"We reduced downtime massively after switching providers.\" | Operations Director\n\"Fast response, clear communication, and very strong execution.\" | Facilities Manager\n\"The reporting quality and follow-up are on another level.\" | Property Lead",
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
            ->where('key', 'testimonials')
            ->delete();
    }
};
