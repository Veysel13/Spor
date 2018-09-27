<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHastaliklarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hastaliklar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->string('hastalik_isim');
            $table->integer('hastalik_kategori');
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
        Schema::dropIfExists('hastaliklar');
    }
}
