<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();
        
        // Only run ALTER DATABASE for MySQL/MariaDB (not SQLite)
        if (in_array($driver, ['mysql', 'mariadb'])) {
            try {
                $databaseName = DB::getDatabaseName();
                DB::statement("ALTER DATABASE `{$databaseName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            } catch (\Exception $e) {
                // Ignore if database charset can't be changed
            }
        }
        
        // Update the news table to use utf8mb4 for better Khmer support
        // SQLite doesn't support charset/collation changes, so skip for SQLite
        if (in_array($driver, ['mysql', 'mariadb'])) {
            Schema::table('news', function (Blueprint $table) {
                $table->string('title')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->change();
                $table->text('content')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->change();
            });
            
            // Also update category table if it exists
            if (Schema::hasTable('category')) {
                Schema::table('category', function (Blueprint $table) {
                    $table->string('name')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->change();
                });
            }
            
            // Update users table for Khmer names
            Schema::table('users', function (Blueprint $table) {
                $table->string('name')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->change();
            });
        }
        // SQLite already supports UTF-8 by default, no changes needed
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();
        
        // Only revert for MySQL/MariaDB (not SQLite)
        if (in_array($driver, ['mysql', 'mariadb'])) {
            // Revert back to default charset
            Schema::table('news', function (Blueprint $table) {
                $table->string('title')->charset('utf8')->collation('utf8_unicode_ci')->change();
                $table->text('content')->charset('utf8')->collation('utf8_unicode_ci')->change();
            });
            
            if (Schema::hasTable('category')) {
                Schema::table('category', function (Blueprint $table) {
                    $table->string('name')->charset('utf8')->collation('utf8_unicode_ci')->change();
                });
            }
            
            Schema::table('users', function (Blueprint $table) {
                $table->string('name')->charset('utf8')->collation('utf8_unicode_ci')->change();
            });
        }
    }
};
