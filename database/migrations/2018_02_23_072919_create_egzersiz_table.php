<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEgzersizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egzersiz', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->string('egzersiz_isim');
            $table->integer('egzersiz_kategori')->nullable();
            $table->integer('egzersiz_hareket')->nullable();
            $table->string('resim')->nullable();
            $table->string('resim_iki')->nullable();
            $table->string('video')->nullable();
            $table->text('aciklama')->nullable();
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
        Schema::dropIfExists('hastalar');
    }
}
