<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pilihan_id');
            $table->string('kodepeserta')->unique();
            $table->string('nama');
            $table->string('nohandphone')->unique();
            $table->string('email')->unique();
            $table->string('nostr');
            $table->string('asalpengcab');
            $table->string('provinsi');
            $table->boolean('statusbayar')->default(false);
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
        Schema::dropIfExists('pesertas');
    }
}
