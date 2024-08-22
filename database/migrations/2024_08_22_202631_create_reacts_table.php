<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('react_user_id')->constrained('users')->onDelete('cascade');
            $table->enum('reaction_type', ['like', 'angry', 'sad', 'happy', 'love']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reacts');
    }

};
