<?php

namespace App\Enums;

enum TransactionStatus : string
{
    case DRAFT = 'DRAFT';

    case COMPLETED = 'COMPLETED';

    case CANCELLED = 'CANCELLED';
}