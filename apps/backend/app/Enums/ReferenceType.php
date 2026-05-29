<?php

namespace App\Enums;

enum ReferenceType:string
{
    case PURCHASE = 'PURCHASE';

    case SALE = 'SALE';

    case ADJUSTMENT = 'ADJUSTMENT';

    case RETURN = 'RETURN';
}