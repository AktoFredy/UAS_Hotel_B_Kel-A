<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orwis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_booking')->constrained('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_wisata')->constrained('paket_wisatas')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status_pembayaran');
            $table->boolean('supir');
            $table->boolean('kendaraan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orwis');
    }
};
