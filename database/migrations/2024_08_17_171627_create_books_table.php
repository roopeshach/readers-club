<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name'); // title
            $table->string('book_code')->unique(); // isbn            
            $table->string('release_version'); // edition
            $table->foreignId('genre_id')->constrained('categories'); // category_id
            $table->foreignId('owner_id')->constrained('users'); // user_id
            $table->string('image_path')->nullable(); // cover_art
            $table->unsignedInteger('view_count')->default(0); // views
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('books');
    }
    
};
