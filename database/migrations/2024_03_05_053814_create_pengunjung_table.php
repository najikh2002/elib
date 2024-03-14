<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengunjungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengunjung', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->timestamps();

            $table->unique('tanggal');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengunjung');
    }
}
