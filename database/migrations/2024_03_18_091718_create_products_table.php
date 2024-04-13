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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->mediumText('small_description');
            $table->longText('description');

            $table->integer('original_price');
            $table->integer('selling_price');
            $table->integer('quantity');
            $table->tinyInteger('trending')->default('0')->comment('0=not-featured, 1=trending');
            $table->tinyInteger('featured')->default('0')->comment('0=not-trending, 1=featured');
            $table->tinyInteger('status')->default('0')->comment('0=visible, 1=hidden');

            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};