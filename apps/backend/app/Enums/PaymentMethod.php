<?php

namespace App\Enums;

enum PaymentMethod:string
{
    case CASH = 'CASH';

    case QRIS = 'QRIS';

    case TRANSFER = 'TRANSFER';

    case E_WALLET = 'E_WALLET';
}