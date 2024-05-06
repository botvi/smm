<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->unsignedBigInteger('kategori_id'); // Kolom untuk menampung ID kategori
            $table->bigInteger('price');
            $table->integer('min');
            $table->integer('max');
            $table->text('description');
            $table->integer('refill');
            $table->string('average_time');
            $table->timestamps();

            // Menambahkan foreign key untuk kategori_id
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanans');
    }
}
