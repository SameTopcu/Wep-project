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
        Schema::create('home_items', function (Blueprint $table) {
            $table->id();
            $table->string('destination_heading')->nullable();
            $table->text('destination_subheading')->nullable();
            $table->string('destination_status')->nullable();
            $table->string('feature_status')->nullable();
            $table->string('package_heading')->nullable();
            $table->string('package_subheading')->nullable();
            $table->string('package_status')->nullable();
            $table->string('testimonial_heading')->nullable();
            $table->string('testimonial_subheading')->nullable();
            $table->string('testimonial_background')->nullable();
            $table->string('testimonial_status')->nullable();
            $table->string('blog_heading')->nullable();
            $table->string('blog_subheading')->nullable();
            $table->string('blog_status')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_items');
    }
};
