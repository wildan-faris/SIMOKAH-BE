<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubAktivitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("aktivitas_id");
            $table->foreign("aktivitas_id")->references("id")->on("aktivitas")->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string("name");
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
        Schema::dropIfExists('sub_aktivitas');
    }
}
