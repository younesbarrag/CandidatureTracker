<?php

namespace App\Http\Requests\Candidature;

use App\Enums\StatutCandidature;
use App\Enums\PrioriteCandidature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * UpdateCandidatureRequest
 *
 * Différence avec Store :
 * - authorize() vérifie que l'user est propriétaire.
 * - 'sometimes' : le champ est validé seulement s'il est présent dans la requête.
 *   Permet les mises à jour partielles (sémantique PATCH).
 */
class UpdateCandidatureRequest extends FormRequest
{
    /**
     * Vérifier la propriété directement ici.
     * Double sécurité : Policy dans le Controller + FormRequest.
     */
    public function authorize(): bool
    {
        $candidature = $this->route('candidature');
        return $candidature && $candidature->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'entreprise'       => ['sometimes', 'required', 'string', 'max:255'],
            'poste'            => ['sometimes', 'required', 'string', 'max:255'],
            'url_offre'        => ['nullable', 'url', 'max:500'],
            'statut'           => ['sometimes', 'required', new Enum(StatutCandidature::class)],
            'priorite'         => ['sometimes', 'required', new Enum(PrioriteCandidature::class)],
            'notes'            => ['nullable', 'string', 'max:5000'],
            'date_candidature' => ['sometimes', 'required', 'date', 'before_or_equal:today'],
            'fichier'          => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'entreprise.required'       => "Le nom de l'entreprise est obligatoire.",
            'poste.required'            => 'Le poste visé est obligatoire.',
            'url_offre.url'             => "L'URL doit être une adresse valide.",
            'statut.required'           => 'Le statut est obligatoire.',
            'priorite.required'         => 'La priorité est obligatoire.',
            'date_candidature.required' => 'La date est obligatoire.',
            'date_candidature.before_or_equal' => 'La date ne peut pas être dans le futur.',
            'fichier.mimes'             => 'Le fichier doit être PDF ou Word.',
            'fichier.max'               => 'Le fichier ne peut pas dépasser 5 Mo.',
        ];
    }
}
