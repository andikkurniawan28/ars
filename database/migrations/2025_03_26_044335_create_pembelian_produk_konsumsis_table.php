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
        Schema::create('pembelian_produk_konsumsis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('supplier_id')->constrained();
            $table->foreignId('cabang_id')->constrained();
            $table->foreignId('produk_konsumsi_id')->constrained();
            $table->foreignId('akun_kas_id')->constrained('akuns')->onDelete('cascade');
            $table->float('qty');
            $table->double('tagihan');
            $table->double('dibayar');
            $table->double('sisa');
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
        Schema::dropIfExists('pembelian_produk_konsumsis');
    }
};
