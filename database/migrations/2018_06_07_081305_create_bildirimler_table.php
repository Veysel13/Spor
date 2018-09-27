<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBildirimlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bildirimler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->integer('gonderilen_id');
            $table->text('mesaj_detay')->nullable();
            $table->integer('mesaj_durum')->nullable();
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
        Schema::dropIfExists('bildirimler');
    }
}
