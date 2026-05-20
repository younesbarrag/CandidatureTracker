<?php

namespace App\Enums;

enum PrioriteCandidature: string
{
    case Haute   = 'haute';
    case Moyenne = 'moyenne';
    case Basse   = 'basse';

    public function label(): string
    {
        return match($this) {
            self::Haute   => '🔴 Haute',
            self::Moyenne => '🟡 Moyenne',
            self::Basse   => '🟢 Basse',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::Haute   => 'badge-red',
            self::Moyenne => 'badge-yellow',
            self::Basse   => 'badge-green',
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
