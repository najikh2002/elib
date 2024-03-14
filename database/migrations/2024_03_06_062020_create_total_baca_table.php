<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalBacaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_baca', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kodebuku', 10);
            $table->string('kodeanggota', 20);

            $table->foreign('kodebuku')->references('kodebuku')->on('buku')->onDelete('cascade');

            $table->foreign('kodeanggota')->references('kodeanggota')->on('anggota')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('total_baca');
    }
}
