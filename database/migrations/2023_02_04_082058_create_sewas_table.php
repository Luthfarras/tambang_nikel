<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_sewa');
            $table->foreignId('kendaraan_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('driver_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('pihak_1');
            $table->integer('pihak_2');
            $table->boolean('acc_1')->default('0');
            $table->boolean('acc_2')->default('0');
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
        Schema::dropIfExists('sewas');
    }
};
