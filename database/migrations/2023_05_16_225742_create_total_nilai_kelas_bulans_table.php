<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalNilaiKelasBulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_nilai_kelas_bulans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sub_aktivitas_id");
            $table->unsignedBigInteger("kelas_id");
            $table->unsignedBigInteger("bulan_id");
            $table->float("nilai");
            $table->foreign("sub_aktivitas_id")->references("id")->on("sub_aktivitas")->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign("bulan_id")->references("id")->on("bulans")->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('total_nilai_kelas_bulans');
    }
}
