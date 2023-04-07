<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->bigInteger("nis");
            $table->string("jenis_kelamin");
            $table->string("tempat_lahir");
            $table->date("tanggal_lahir");
            $table->unsignedBigInteger("orang_tua_id");
            $table->foreign("orang_tua_id")->references("id")->on("orang_tuas");
            $table->unsignedBigInteger("kelas_id");
            $table->foreign("kelas_id")->references("id")->on("kelas");
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
        Schema::dropIfExists('siswas');
    }
}
