<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('slug', 191)->nullable()->after('title');
        });

        // Backfill slugs for existing rows, keeping Khmer letters so the URL stays meaningful.
        $used = [];

        DB::table('news')->orderBy('id')->get(['id', 'title'])->each(function ($row) use (&$used) {
            $base = preg_replace('/[^\p{L}\p{M}\p{N}]+/u', '-', (string) $row->title) ?? '';
            $base = mb_strtolower(trim($base, '-'), 'UTF-8');
            $base = trim(mb_substr($base, 0, 120, 'UTF-8'), '-');
            $base = $base !== '' ? $base : 'news';

            $slug = $base;
            $suffix = 1;
            while (in_array($slug, $used, true)) {
                $slug = $base.'-'.(++$suffix);
            }

            $used[] = $slug;

            DB::table('news')->where('id', $row->id)->update(['slug' => $slug]);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
