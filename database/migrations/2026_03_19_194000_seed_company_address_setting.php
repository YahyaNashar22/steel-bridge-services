<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        $now = now();

        DB::table('settings')->upsert([
            [
                'key' => 'company_address',
                'value' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ], ['key'], ['value', 'updated_at']);
    }

    public function down(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        DB::table('settings')
            ->where('key', 'company_address')
            ->delete();
    }
};
