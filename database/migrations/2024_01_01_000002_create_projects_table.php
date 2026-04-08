<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('number');        // e.g. "01"
            $table->string('tag');           // category label
            $table->string('title');
            $table->text('description');
            $table->string('stack');         // comma-separated tags
            $table->string('link')->default('#');
            $table->string('bg_image')->nullable(); // optional background image URL
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
