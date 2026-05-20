<?php

namespace App\Enums;

enum ResultatEntretien: string
{
    case EnAttente  = 'en_attente';
    case Positif    = 'positif';
    case Negatif    = 'negatif';
    case SansSuite  = 'sans_suite';

    public function label(): string
    {
        return match($this) {
            self::EnAttente => '⏳ En attente',
            self::Positif   => '✅ Positif',
            self::Negatif   => '❌ Négatif',
            self::SansSuite => '➖ Sans suite',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::EnAttente => 'badge-yellow',
            self::Positif   => 'badge-green',
            self::Negatif   => 'badge-red',
            self::SansSuite => 'badge-gray',
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
