<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKurumlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurumlar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->string('kurum_resim')->nullable();
            $table->string('kurum_arayanad');
            $table->string('kurum_arayansoyad');
            $table->string('kurum_arayantelefon')->nullable();
            $table->string('kurum_arayaneposta')->nullable();
            $table->string('kurum_arayansifre')->nullable();

            $table->string('kurum_adi')->nullable();
            $table->string('kurum_yetkiliadi')->nullable();
            $table->string('kurum_yetkilinumara')->nullable();
            $table->string('kurum_vergidairesi')->nullable();
            $table->integer('kurum_verginumarasi')->nullable();
            $table->string('kurum_yetkilicinsiyet')->nullable();


            $table->string('kurum_ulke')->nullable();
            $table->string('kurum_il')->nullable();
            $table->string('kurum_ilce')->nullable();
            $table->string('kurum_acikadress')->nullable();

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
        Schema::dropIfExists('kurumlar');
    }
}
