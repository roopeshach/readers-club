<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });

        // Add foreign key to books table
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('publisher_id')->nullable()->after('author')->change();
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['publisher_id']);
            $table->dropColumn('publisher_id');
        });

        Schema::dropIfExists('publishers');
    }
};
