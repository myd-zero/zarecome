<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_detail')->unsigned();
            $table->foreign('id_detail')->references('id')->on('kuliners')->onDelete('cascade');
            $table->string('nmcafe', 255);
            $table->string('altcafe', 255);
            $table->string('file_menu', 255);
            $table->string('keterangan_menu', 255);
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
        Schema::dropIfExists('details');
    }
}
