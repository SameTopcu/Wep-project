<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string(column: 'country')->nullable();
            $table->string(column: 'language')->nullable();
            $table->string(column: 'currency')->nullable();
            $table->string('area')->nullable();
            $table->string(column: 'time_zone')->nullable();
            $table->string(column: 'visa_requirement')->nullable();
            $table->text(column: 'best_time')->nullable();
            $table->string('health_safety')->nullable();
            $table->text('map')->nullable();  
            $table->string('featured_photo')->nullable();
            $table->integer('view_count');
            $table->text('activity')->nullable();
            $table->timestamps();
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
