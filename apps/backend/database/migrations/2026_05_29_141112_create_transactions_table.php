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
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();

            $table->string('transaction_number')
                ->unique();

            $table->foreignId('cashier_id')
                ->constrained('users');

            $table->decimal('subtotal', 14, 2)
                ->default(0);

            $table->decimal('tax_amount', 14, 2)
                ->default(0);

            $table->decimal('discount_amount', 14, 2)
                ->default(0);

            $table->decimal('total_amount', 14, 2)
                ->default(0);

            $table->string('status')
                ->default('DRAFT');

            $table->timestamp('transaction_date')
                ->useCurrent();

            $table->timestamps();

            $table->index('transaction_number');
            $table->index('cashier_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
