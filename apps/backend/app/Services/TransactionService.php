<?php

namespace App\Services;

use App\Enums\TransactionStatus;
use App\Enums\ReferenceType;
use App\Enums\PaymentStatus;
use App\Enums\PaymentMethod;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\TransactionItem;
use App\Models\Payment;
use App\Services\InventoryService;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function createTransaction(
        int $cashierId,
        array $items,
        array $payment
    ): Transaction
    {
        return DB::transaction(function () use (
            $cashierId,
            $items,
            $payment
        ) {

            if (empty($items)) {
                throw new \Exception('Cart cannot be empty.');
            }

            $subtotal = 0;

            $transactionItems = [];

            foreach ($items as $item) {

                $product = Product::find($item['product_id']);

                if (!$product) {
                    throw new \Exception('Product not found.');
                }

                $quantity = (int) $item['quantity'];

                if ($quantity <= 0) {
                    throw new \Exception('Invalid quantity.');
                }

                if ($product->stock_quantity < $quantity) {
                    throw new \Exception(
                        "Insufficient stock for {$product->name}"
                    );
                }

                $lineSubtotal = $product->price * $quantity;

                $subtotal += $lineSubtotal;

                $transactionItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $lineSubtotal,
                ];
            }

            $transaction = Transaction::create([
                'transaction_number' => $this->generateTransactionNumber(),
                'cashier_id'         => $cashierId,
                'subtotal'           => $subtotal,
                'tax_amount'         => 0,
                'discount_amount'    => 0,
                'total_amount'       => $subtotal,
                'status'             => TransactionStatus::DRAFT->value,
                'transaction_date'   => now(),
            ]);

            foreach ($transactionItems as $item) {

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $item['product']->id,
                'quantity'       => $item['quantity'],
                'price'          => $item['price'],
                'subtotal'       => $item['subtotal'],
            ]);

            $this->inventoryService->decreaseStock(
                product: $item['product'],
                quantity: $item['quantity'],
                userId: $cashierId,
                referenceType: ReferenceType::SALE,
                referenceId: $transaction->id,
                notes: 'POS Transaction'
            );
        }

            $paidAmount = $payment['paid_amount'] ?? 0;

            if ($paidAmount < $transaction->total_amount) {
                throw new \Exception('Insufficient payment amount.');
            }

            $paymentMethod = PaymentMethod::tryFrom(
                $payment['payment_method']
            );

            if (!$paymentMethod) {
                throw new \Exception(
                    'Invalid payment method.'
                );
            }

            Payment::create([
                'transaction_id' => $transaction->id,
                // 'payment_method' => $payment['payment_method'],
                'payment_method' => $paymentMethod->value,
                'amount' => $paidAmount,
                'status' => PaymentStatus::PAID->value,
                'paid_at' => now(),
            ]);

            $transaction->update([
                'status' => TransactionStatus::COMPLETED->value,
            ]);

            return $transaction->fresh([
                'items',
                'payments',
            ]);
        });
    }

    private function generateTransactionNumber(): string
    {
        $count = Transaction::count() + 1;

        return sprintf(
            'TRX-%s-%06d',
            now()->format('Ymd'),
            $count
        );
    }

    private InventoryService $inventoryService;

    public function __construct(
        InventoryService $inventoryService
    )
    {
        $this->inventoryService = $inventoryService;
    }
}