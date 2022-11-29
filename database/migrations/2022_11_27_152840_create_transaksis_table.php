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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('jumlah_pembelian');
            $table->string('total_harga');
            $table->string('status');

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
        Schema::dropIfExists('transaksis');
    }
};
