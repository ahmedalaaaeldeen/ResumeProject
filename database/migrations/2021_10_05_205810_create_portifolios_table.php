<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortifoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portifolios', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('slug');
            $table->string('title');

            $table->unsignedBigInteger('portifolioCategoryId');
            $table->foreign('portifolioCategoryId')->references('id')->on('portifolio_categories')->onDelete('CASCADE');
            
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
        Schema::dropIfExists('portifolios');
    }
}
