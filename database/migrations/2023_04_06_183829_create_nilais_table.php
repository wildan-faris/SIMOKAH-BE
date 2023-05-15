<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->integer("nilai");
            $table->date("tanggal");
            $table->string("penilai");
            $table->unsignedBigInteger("siswa_id");
            $table->foreign("siswa_id")->references("id")->on("siswas")->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger("sub_aktivitas_id");
            $table->foreign("sub_aktivitas_id")->references("id")->on("sub_aktivitas")->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('nilais');
    }
}
