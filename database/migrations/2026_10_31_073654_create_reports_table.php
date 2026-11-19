
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->string('ticket_number')->unique();

            $table->boolean('is_anonymous')->default(false);
            $table->string('reporter_name')->nullable();
            $table->string('reporter_phone')->nullable();

            $table->string('photo_path');

            // Koordinat tidak wajib karena alamat diisi manual
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('location_name');
            $table->text('address_details');

            $table->enum('density_level', [
                'ringan',
                'sedang',
                'berat'
            ]);
            $table->string('photo_path');
            $table->json('impacts')->nullable();

            $table->text('notes')->nullable();

            $table->enum('status', [
                'BARU',
                'DIVERIFIKASI',
                'DIJADWALKAN',
                'DITANGANI',
                'SELESAI',
                'DITOLAK',
                'DITUNDA',
                'BUTUH_DUKUNGAN'
            ])->default('BARU');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
