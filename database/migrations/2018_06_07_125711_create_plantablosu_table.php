<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantablosuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantablosu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->integer('hasta_id');
            $table->date('baslangic_tarihi')->nullable();
            $table->date('bitis_tarihi')->nullable();
            $table->string('program_adi')->nullable();
            $table->integer('plan_numarasi');
            $table->string('egzersiz_isim');
            $table->string('haftalik_tekrar')->nullable();
            $table->integer('set')->nullable()->nullable()->default(0);
            $table->integer('tekrar')->nullable()->nullable()->default(0);
            $table->integer('dinlenme')->nullable()->nullable()->default(0);
            $table->enum('pazartesi',array('0', '1'))->nullable()->default(0);
            $table->enum('sali',array('0', '1'))->nullable()->default(0);
            $table->enum('carsamba',array('0', '1'))->nullable()->default(0);
            $table->enum('persembe',array('0', '1'))->nullable()->default(0);
            $table->enum('cuma',array('0', '1'))->nullable()->default(0);
            $table->enum('cumartesi',array('0', '1'))->nullable()->default(0);
            $table->enum('pazar',array('0', '1'))->nullable()->default(0);
            $table->enum('plan_durum',array('0', '1'))->nullable()->default(0);
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
        Schema::dropIfExists('plantablosu');
    }
}
