<?php

namespace App\Http\Requests\Candidature;

use App\Enums\StatutCandidature;
use App\Enums\PrioriteCandidature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

/**
 * StoreCandidatureRequest
 *
 * Bonne pratique : validation + autorisation HORS du Controller.
 * Le Controller reste propre et ne contient que la logique métier.
 *
 * Génération : php artisan make:request Candidature/StoreCandidatureRequest
 */
class StoreCandidatureRequest extends FormRequest
{
    /**
     * Seul un utilisateur authentifié peut créer une candidature.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Règles de validation.
     * Utilise Rule::enum() pour valider les Enums PHP 8.1.
     */
    public function rules(): array
    {
        return [
            'entreprise'       => ['required', 'string', 'max:255'],
            'poste'            => ['required', 'string', 'max:255'],
            'url_offre'        => ['nullable', 'url', 'max:500'],
            'statut'           => ['required', new Enum(StatutCandidature::class)],
            'priorite'         => ['required', new Enum(PrioriteCandidature::class)],
            'notes'            => ['nullable', 'string', 'max:5000'],
            'date_candidature' => ['required', 'date', 'before_or_equal:today'],
            'fichier'          => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'], // 5 Mo max
        ];
    }

    /**
     * Messages d'erreur en français.
     */
    public function messages(): array
    {
        return [
            'entreprise.required'       => "Le nom de l'entreprise est obligatoire.",
            'entreprise.max'            => "Le nom de l'entreprise ne peut pas dépasser 255 caractères.",
            'poste.required'            => 'Le poste visé est obligatoire.',
            'url_offre.url'             => "L'URL de l'offre doit être une adresse valide (ex: https://...).",
            'statut.required'           => 'Le statut est obligatoire.',
            'priorite.required'         => 'La priorité est obligatoire.',
            'date_candidature.required' => 'La date de candidature est obligatoire.',
            'date_candidature.date'     => 'La date de candidature doit être une date valide.',
            'date_candidature.before_or_equal' => 'La date de candidature ne peut pas être dans le futur.',
            'fichier.mimes'             => 'Le fichier doit être au format PDF ou Word (.doc, .docx).',
            'fichier.max'               => 'Le fichier ne peut pas dépasser 5 Mo.',
        ];
    }
}
