<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bts', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->unsignedBigInteger('id_jenis_bts');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('tinggi_tower', 8, 2);
            $table->decimal('panjang_tanah', 8, 2);
            $table->decimal('lebar_tanah', 8, 2);
            $table->boolean('ada_genset')->default(false);
            $table->boolean('ada_tembok_batas')->default(false);
//            $table->unsignedBigInteger('id_user_pic');
            $table->unsignedBigInteger('id_pemilik')->nullable();
            $table->unsignedBigInteger('id_wilayah');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();

            $table->foreign('id_jenis_bts')->references('id')->on('jenis_bts')->onDelete('cascade');
//            $table->foreign('id_user_pic')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_pemilik')->references('id')->on('pemilik')->onDelete('cascade');
            $table->foreign('id_wilayah')->references('id')->on('wilayah')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('edited_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bts');
    }
};
