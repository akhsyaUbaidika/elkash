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
        Schema::create('stock_movements', function (Blueprint $table) {

            $table->id();

            $table->foreignId('product_id')
                ->constrained('products');

            $table->foreignId('user_id')
                ->constrained('users');

            $table->string('movement_type', 50);

            $table->integer('quantity');

            $table->integer('previous_stock');

            $table->integer('current_stock');

            $table->string('reference_type')
                ->nullable();

            $table->unsignedBigInteger('reference_id')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->timestamp('created_at')
                ->useCurrent();

            $table->index('product_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
