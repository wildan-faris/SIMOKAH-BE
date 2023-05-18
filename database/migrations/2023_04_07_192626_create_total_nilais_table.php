<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("siswa_id");
            $table->unsignedBigInteger("sub_aktivitas_id");
            $table->unsignedBigInteger("aktivitas_id");
            $table->unsignedBigInteger("kelas_id");
            $table->float("nilai");
            $table->date("tanggal");
            $table->foreign("siswa_id")->references("id")->on("siswas")->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign("sub_aktivitas_id")->references("id")->on("sub_aktivitas")->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign("aktivitas_id")->references("id")->on("aktivitas")->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign("kelas_id")->references("id")->on("kelas")->onDelete('cascade')
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
        Schema::dropIfExists('total_nilais');
    }
}
