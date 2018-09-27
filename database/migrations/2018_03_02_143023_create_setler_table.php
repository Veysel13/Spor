<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->integer('hasta_id');
            $table->date('baslangic_tarihi')->nullable();
            $table->date('bitis_tarihi')->nullable();
            $table->string('program_adi')->nullable();
            $table->string('egzersiz_isim')->nullable();
            $table->integer('set')->nullable();
            $table->integer('tekrar')->nullable();
            $table->integer('dinlenme')->nullable();
            $table->string('haftalik_tekrar')->nullable();
            $table->string('gunluk_tekrar')->nullable();
            $table->integer('plan_sayisi')->nullable();
            $table->integer('aktif')->default(1);
            $table->dateTime('silinme_tarihi')->nullable();
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
        Schema::dropIfExists('setler');
    }
}
