<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('volunteer_registrations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
        $table->string('name');
        $table->string('phone');
        $table->string('origin')->nullable();
        $table->integer('age')->nullable();
        $table->enum('role', ['pengangkut', 'pencatat', 'dokumentasi', 'logistik', 'alat']);
        $table->boolean('health_statement')->default(false);
        $table->enum('status', ['MENDAFTAR', 'DIKONFIRMASI', 'HADIR', 'SELESAI', 'DAFTAR_TUNGGU', 'TIDAK_HADIR', 'DITOLAK'])->default('MENDAFTAR');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_registrations');
    }
};
