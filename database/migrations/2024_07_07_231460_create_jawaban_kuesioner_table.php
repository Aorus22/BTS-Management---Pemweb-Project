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
        Schema::create('jawaban_kuesioner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_monitoring');
            $table->unsignedBigInteger('id_kuesioner');
            $table->unsignedBigInteger('id_pilihan_kuesioner');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();

            $table->foreign('id_monitoring')->references('id')->on('monitoring')->onDelete('cascade');
            $table->foreign('id_kuesioner')->references('id')->on('kuesioner')->onDelete('cascade');
            $table->foreign('id_pilihan_kuesioner')->references('id')->on('pilihan_kuesioner')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('edited_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_kuesioner');
    }
};
