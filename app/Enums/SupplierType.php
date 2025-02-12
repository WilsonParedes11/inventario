<?php

namespace App\Enums;

enum SupplierType: string
{
    case DISTRIBUTOR = 'distribuidor';

    case WHOLESALER = 'mayorista';

    case PRODUCER = 'productor';

    public function label(): string
    {
        return match ($this) {
            self::DISTRIBUTOR => __('Distribuidor'),
            self::WHOLESALER => __('Mayorista'),
            self::PRODUCER => __('Productor'),
        };
    }
}
