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
        Schema::create('produk_rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_konsol_id')->constrained();
            $table->string('nama')->unique();
            $table->float('durasi');
            $table->double('harga');
            $table->float('poin')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_rentals');
    }
};
