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
        Schema::create('buku_besars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_produk_konsumsi_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('penjualan_produk_konsumsi_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('penjualan_produk_rental_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('jurnal_umum_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('akun_id')->constrained();
            $table->text('keterangan');
            $table->double('debit')->nullable();
            $table->double('kredit')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_besars');
    }
};
