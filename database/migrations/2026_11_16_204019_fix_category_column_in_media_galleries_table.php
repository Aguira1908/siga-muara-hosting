
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE media_galleries
            MODIFY category VARCHAR(50) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE media_galleries
            MODIFY category ENUM(
                'pelabuhan',
                'eceng_gondok',
                'gotong_royong'
            ) NOT NULL
        ");
    }
};
