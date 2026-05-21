<?php

namespace App\Enums;

enum StatutCandidature: string
{
    case Envoyee           = 'candidature_envoyee';
    case EnAttente         = 'en_attente';
    case EntretienPlanifie = 'entretien_planifie';
    case OffreRecue        = 'offre_recue';
    case Refusee           = 'refusee';
    case Abandonnee        = 'abandonnee';

    public function label(): string
    {
        return match($this) {
            self::Envoyee           => '📄 Candidature envoyée',
            self::EnAttente         => '⏳ En attente',
            self::EntretienPlanifie => '📅 Entretien planifié',
            self::OffreRecue        => '🎉 Offre reçue',
            self::Refusee           => '❌ Refusée',
            self::Abandonnee        => '📁 Abandonnée',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::Envoyee           => 'badge-blue',
            self::EnAttente         => 'badge-gray',
            self::EntretienPlanifie => 'badge-purple',
            self::OffreRecue        => 'badge-green',
            self::Refusee           => 'badge-red',
            self::Abandonnee        => 'badge-gray',
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
