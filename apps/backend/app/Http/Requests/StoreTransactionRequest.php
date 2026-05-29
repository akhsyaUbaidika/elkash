<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],

            'items.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'payment' => ['required', 'array'],

            'payment.payment_method' => [
                'required',
                'string',
            ],

            'payment.paid_amount' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}