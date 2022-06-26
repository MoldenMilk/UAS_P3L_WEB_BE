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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string("Nama_Mobil");
            $table->string("Tipe_Mobil");
            $table->string("Transmisi");
            $table->string("Plat_Nomor");
            $table->string("Warna_Mobil");
            $table->string("Kapasitas");
            $table->string("Fasilitas");
            $table->string("Tanggal_Servis");
            $table->string("Bahan_Bakar");
            $table->string("Volume_Bahan_Bakar");
            $table->string("Harga_Sewa");
            $table->string("No_STNK");
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
        Schema::dropIfExists('mobils');
    }
};
