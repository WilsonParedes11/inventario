<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case CANCEL = 2;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Pendiente'),
            self::COMPLETE => __('Completado'),
            self::CANCEL => __('Cancelado'),
        };
    }
}
