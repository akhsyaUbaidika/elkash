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
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('transaction_id')
                ->constrained('transactions')
                ->cascadeOnDelete();

            $table->string('payment_method');

            $table->decimal('amount', 14, 2);

            $table->string('status')
                ->default('PENDING');

            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamps();

            $table->index('transaction_id');
            $table->index('payment_method');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
