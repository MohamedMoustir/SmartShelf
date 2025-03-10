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
            $table->unsignedBigInteger('rayon_id');
            $table->unsignedBigInteger('cateigorie_id');
            $table->string('name');
            $table->text('description');
            $table->decimal('prace',10,2)->nullable();
            $table->integer('rating')->min(1)->max(5);
            $table->decimal('sale_price');
            $table->foreign('rayon_id')->references('id')->on('rayons')->onDelete('cascade');
            $table->foreign('cateigorie_id')->references('id')->on('cateigories')->onDelete('cascade');
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
