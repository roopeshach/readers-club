<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn')->unique();
            $table->string('publisher');
            $table->integer('edition');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('author_id')->constrained();
            $table->foreignId('user_id')->constrained(); // Assuming books are added by users
            $table->string('cover_art')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
