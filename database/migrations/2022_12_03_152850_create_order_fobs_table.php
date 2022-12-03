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
        Schema::create('order_fobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_booking')->constrained('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_menu')->constrained('fobs')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status_pembayaran');
            $table->integer('jumlah'); // jangan lupa mengurangi stok apabila jumlah tidak == 0
            $table->integer('total'); //total harga dari makanan * jumlah dipesan
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
        Schema::dropIfExists('order_fobs');
    }
};
