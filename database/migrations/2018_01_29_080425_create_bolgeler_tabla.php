<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBolgelerTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bolgeler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ekleyen_id');
            $table->string('isim');
            $table->text('ozellikleri')->nullable();
            $table->string('resim')->nullable();
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
        Schema::dropIfExists('bolgeler');
    }
}
