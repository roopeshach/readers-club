<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_reference')->constrained('books'); // book_id
            $table->foreignId('commenter_id')->constrained('users'); // user_id
            $table->text('comment_text'); // content
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('comments');
    }
    
};
