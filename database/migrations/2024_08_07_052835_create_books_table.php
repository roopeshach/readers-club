<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();  // This creates an unsigned big integer primary key
            $table->string('title');
            $table->string('isbn')->unique();
            $table->string('author');
            $table->unsignedBigInteger('publisher_id'); //  the pulisher_id column
            $table->integer('edition');
            $table->unsignedBigInteger('category_id');  // Foreign key column
            $table->string('cover_art')->nullable();
            $table->unsignedBigInteger('user_id');  // Foreign key column
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
