<?php

namespace App;

enum City: string
{
    case Moscow = 'moscow';
    case Tula = 'tula';
    case SaintsPetersburg = 'st_petersburg';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
        // ["deposit" => "Deposit", "withdraw" => "Withdraw"]
    }

    public function description(): string
    {
        return match ($this) {
            self::Moscow => 'Moscow',
            self::Tula => 'Tula',
            self::SaintsPetersburg => 'Saints Petersburg',
        };
    }

    public function string_to(): string
    {
        return $this->value;
    }
}
