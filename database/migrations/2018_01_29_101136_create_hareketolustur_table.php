<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHareketolusturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hareketolustur', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->string('baslik');
            $table->string('resim')->nullable();
            $table->double('Aaos')->nullable();
            $table->double('Ama')->nullable();
            $table->double('KendalMcreacy')->nullable();
            $table->string('bolge');
            $table->string('eklem');
            $table->string('hareket');
            $table->text('ozellikleri')->nullable();
            $table->integer('aktif')->default(1);
            $table->dateTime('silme_tarihi')->nullable();
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hareketolustur');
    }
}
