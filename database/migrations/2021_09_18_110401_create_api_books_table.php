<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('isbn');
            $table->string('authors');
            $table->string('country');
            $table->string('number_of_pages');
            $table->string('publisher');
            $table->dateTime('release_date');
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
        Schema::dropIfExists('api_books');
    }
}
