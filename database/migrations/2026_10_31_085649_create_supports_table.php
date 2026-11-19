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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->string('origin_rantau');
            $table->enum('type', ['barang', 'sponsorship']);
            $table->text('item_details'); // detail barang atau nama kegiatan
            $table->string('proof_path')->nullable(); // foto bukti / resi
            $table->text('message')->nullable();
            
            $table->enum('status', [
                'MENUNGGU_VERIFIKASI', 'TERVERIFIKASI', 'DIGUNAKAN', 'DITUTUP', 'DITOLAK'
            ])->default('MENUNGGU_VERIFIKASI');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};