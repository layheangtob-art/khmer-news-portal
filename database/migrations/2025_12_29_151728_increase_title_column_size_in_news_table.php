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
        
        // Only run ALTER TABLE for MySQL/MariaDB (not SQLite)
        if (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('ALTER TABLE `news` MODIFY `title` VARCHAR(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();
        
        // Only revert for MySQL/MariaDB (not SQLite)
        if (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('ALTER TABLE `news` MODIFY `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        }
    }
};
