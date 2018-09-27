<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHazirplanlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hazirplanlar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->string('plan_ismi');
            $table->string('egzersiz_isim')->nullable();
            $table->integer('set')->nullable();
            $table->integer('tekrar')->nullable();
            $table->integer('dinlenme')->nullable();
            $table->string('haftalik_tekrar')->nullable();
            $table->string('gunluk_tekrar')->nullable();
            $table->integer('kurum_id')->nullable();
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
        Schema::dropIfExists('hazirplanlar');
    }
}
