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
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabang_id')->constrained();
            $table->foreignId('produk_konsumsi_id')->constrained();
            $table->foreignId('pembelian_produk_konsumsi_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('penjualan_produk_konsumsi_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('keterangan');
            $table->float('masuk');
            $table->float('keluar');
            // $table->float('saldo');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
