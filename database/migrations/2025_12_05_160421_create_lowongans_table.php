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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mitra');
            $table->unsignedBigInteger('id_type');
            $table->unsignedBigInteger('id_jenjang');
            $table->unsignedBigInteger('id_keahlian');
            $table->string('job');
            $table->text('keterangan');

            // foreignkey
            $table->foreign('id_mitra')->references('id')->on('users');
            $table->foreign('id_type')->references('id')->on('types');
            $table->foreign('id_jenjang')->references('id')->on('jenjangs');
            $table->foreign('id_keahlian')->references('id')->on('keahlians');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
