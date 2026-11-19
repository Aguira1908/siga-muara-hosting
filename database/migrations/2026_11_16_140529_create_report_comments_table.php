
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('report_id')
                ->constrained('reports')
                ->cascadeOnDelete();

            $table->enum('sender_type', ['WARGA', 'ADMIN']);
            $table->string('sender_name')->nullable();
            $table->text('message');

            // ID akun admin jika pengirim adalah admin
            $table->unsignedBigInteger('user_id')->nullable();

            $table->timestamps();

            $table->index(['report_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_comments');
    }
};
