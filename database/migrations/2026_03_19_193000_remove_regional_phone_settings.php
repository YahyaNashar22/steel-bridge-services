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

        DB::table('settings')
            ->whereIn('key', ['company_phone_jordan', 'company_phone_saudi'])
            ->delete();
    }

    public function down(): void
    {
        if (! Schema::hasTable('settings')) {
            return;
        }

        $now = now();

        DB::table('settings')->upsert([
            ['key' => 'company_phone_jordan', 'value' => '', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'company_phone_saudi', 'value' => '', 'created_at' => $now, 'updated_at' => $now],
        ], ['key'], ['value', 'updated_at']);
    }
};
