<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHastaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->string('hasta_resim')->nullable();
            $table->string('hasta_ad');
            $table->string('hasta_soyad');
            $table->string('hasta_telefon')->nullable();
            $table->string('hasta_eposta')->nullable();
            $table->string('hasta_sifre')->nullable();
            $table->string('hasta_babaadi')->nullable();
            $table->string('hasta_anneadi')->nullable();
            $table->string('hasta_tc')->nullable();
            $table->string('hasta_dogumyeri')->nullable();
            $table->date('hasta_dogumtarihi')->nullable();
            $table->string('hasta_cinsiyet')->nullable();
            $table->string('hasta_medenihali')->nullable();

            $table->string('hasta_kangurubu')->nullable();
            $table->string('hasta_ulke')->nullable();
            $table->string('hasta_il')->nullable();
            $table->string('hasta_ilce')->nullable();
            $table->string('hasta_acikadress')->nullable();

            $table->integer('kurum_id');
            $table->integer('aktif')->default(1);
            $table->dateTime('silme_tarihi')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('hasta');
    }
}
