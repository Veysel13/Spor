<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHastalikHareketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hastalik_hareket', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('hastalik_id');
            $table->integer('hareket_id');
            $table->integer('aktif')->default(1);
            $table->dateTime('silme_tarihi')->nullable();
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
        Schema::dropIfExists('hastalik_hareket');
    }
}
