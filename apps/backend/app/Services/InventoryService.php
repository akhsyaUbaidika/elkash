<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use App\Enums\StockMovementType;
use App\Enums\ReferenceType;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function increaseStock(
        Product $product,
        int $quantity,
        int $userId,
        ?ReferenceType $referenceType = null,
        ?int $referenceId = null,
        ?string $notes = null
    ): void
    {
        DB::transaction(function () use (
            $product,
            $quantity,
            $userId,
            $referenceType,
            $referenceId,
            $notes
        ) {

            $previousStock = $product->stock_quantity;

            $currentStock = $previousStock + $quantity;

            $product->update([
                'stock_quantity' => $currentStock,
            ]);

            StockMovement::create([
                'product_id'      => $product->id,
                'user_id'         => $userId,
                'movement_type'   => StockMovementType::IN->value,
                'quantity'        => $quantity,
                'previous_stock'  => $previousStock,
                'current_stock'   => $currentStock,
                'reference_type'  => $referenceType?->value,
                'reference_id'    => $referenceId,
                'notes'           => $notes,
            ]);
        });
    }

    public function decreaseStock(
        Product $product,
        int $quantity,
        int $userId,
        ?ReferenceType $referenceType = null,
        ?int $referenceId = null,
        ?string $notes = null
    ): void
    {
        DB::transaction(function () use (
            $product,
            $quantity,
            $userId,
            $referenceType,
            $referenceId,
            $notes
        ) {

            $previousStock = $product->stock_quantity;

            if ($previousStock < $quantity) {
                throw new \Exception('Insufficient stock.');
            }

            $currentStock = $previousStock - $quantity;

            $product->update([
                'stock_quantity' => $currentStock,
            ]);

            StockMovement::create([
                'product_id'      => $product->id,
                'user_id'         => $userId,
                'movement_type'   => StockMovementType::OUT->value,
                'quantity'        => $quantity,
                'previous_stock'  => $previousStock,
                'current_stock'   => $currentStock,
                'reference_type'  => $referenceType?->value,
                'reference_id'    => $referenceId,
                'notes'           => $notes,
            ]);
        });
    }

    public function adjustStock(
        Product $product,
        int $newStock,
        int $userId,
        ?string $notes = null
    ): void
    {
        DB::transaction(function () use (
            $product,
            $newStock,
            $userId,
            $notes
        ) {

            $previousStock = $product->stock_quantity;

            $difference = $newStock - $previousStock;

            $product->update([
                'stock_quantity' => $newStock,
            ]);

            StockMovement::create([
                'product_id'      => $product->id,
                'user_id'         => $userId,
                'movement_type'   => StockMovementType::ADJUSTMENT->value,
                'quantity'        => $difference,
                'previous_stock'  => $previousStock,
                'current_stock'   => $newStock,
                'reference_type'  => ReferenceType::ADJUSTMENT->value,
                'reference_id'    => null,
                'notes'           => $notes,
            ]);
        });
    }
}