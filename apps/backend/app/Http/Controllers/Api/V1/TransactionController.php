<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use App\Services\TransactionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
    public function __construct(
        private TransactionService $transactionService
    ) {}

    public function store(
        StoreTransactionRequest $request
    ) {
        try {

            $transaction = $this->transactionService
                ->createTransaction(
                    cashierId: auth()->id(),
                    items: $request->validated()['items'],
                    payment: $request->validated()['payment'],
                );

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully',
                'data' => $transaction,
            ], 201);

        } catch (Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}