<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('supports', function (Blueprint $table) {
            if (!Schema::hasColumn('supports', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('type');
            }

            if (!Schema::hasColumn('supports', 'transfer_amount')) {
                $table->unsignedBigInteger('transfer_amount')->nullable()->after('payment_method');
            }
        });
    }

    public function down(): void
    {
        Schema::table('supports', function (Blueprint $table) {
            if (Schema::hasColumn('supports', 'transfer_amount')) {
                $table->dropColumn('transfer_amount');
            }

            if (Schema::hasColumn('supports', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
        });
    }
};