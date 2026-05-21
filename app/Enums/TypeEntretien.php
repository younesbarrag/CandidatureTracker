<?php

namespace App\Enums;

enum TypeEntretien: string
{
    case Telephone  = 'telephone';
    case Visio      = 'visio';
    case Presentiel = 'presentiel';
    case Technique  = 'technique';
    case Rh         = 'rh';

    public function label(): string
    {
        return match($this) {
            self::Telephone  => ' Téléphone',
            self::Visio      => ' Vidéoconférence',
            self::Presentiel => ' Présentiel',
            self::Technique  => ' Test technique',
            self::Rh         => ' Entretien RH',
        };
    }

    public static function options(): array
    {
        return array_column(
            array_map(fn($case) => ['value' => $case->value, 'label' => $case->label()], self::cases()),
            'label',
            'value'
        );
    }
}
