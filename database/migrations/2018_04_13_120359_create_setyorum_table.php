<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetyorumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setyorum', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->integer('hasta_id');
            $table->text('yorum')->nullable();
            $table->integer('plan_sayisi')->nullable();
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
        Schema::dropIfExists('setyorum');
    }
}
