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
        Schema::create('detail_jurnal_umums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurnal_umum_id')->constrained()->onDelete('cascade');
            $table->foreignId('akun_id')->constrained();
            $table->text('keterangan');
            $table->double('debit')->nullable();
            $table->double('kredit')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_jurnal_umums');
    }
};
