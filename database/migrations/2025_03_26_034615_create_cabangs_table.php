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
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat');
            $table->string('whatsapp');
            $table->foreignId('akun_persediaan_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_pendapatan_konsumsi_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_hutang_konsumsi_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_piutang_konsumsi_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_hpp_konsumsi_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_pendapatan_rental_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_hutang_rental_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_piutang_rental_id')->nullable()->constrained('akuns')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabangs');
    }
};
