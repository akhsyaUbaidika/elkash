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

            $table->foreignId('category_id')
                ->constrained('categories');

            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers');

            $table->string('sku')->unique();

            $table->string('name');

            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->decimal('price', 14, 2);

            $table->decimal('cost_price', 14, 2)
                ->nullable();

            $table->integer('stock_quantity')
                ->default(0);

            $table->integer('minimum_stock')
                ->default(0);

            $table->boolean('is_available')
                ->default(true);

            $table->boolean('is_favorite')
                ->default(false);

            $table->text('image_url')
                ->nullable();

            $table->timestamps();

            $table->softDeletes();

            $table->index('category_id');
            $table->index('supplier_id');
            $table->index('stock_quantity');
            $table->index('is_available');
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
