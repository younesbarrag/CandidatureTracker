<?php

namespace App\Http\Requests\Entretien;

use App\Enums\TypeEntretien;
use App\Enums\ResultatEntretien;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreEntretienRequest extends FormRequest
{
    public function authorize(): bool
    {
        // La candidature doit appartenir à l'user connecté
        $candidature = $this->route('candidature');
        return $candidature && $candidature->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'type'              => ['required', new Enum(TypeEntretien::class)],
            'date_heure'        => ['required', 'date'],
            'notes_preparation' => ['nullable', 'string', 'max:5000'],
            'resultat'          => ['required', new Enum(ResultatEntretien::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'       => "Le type d'entretien est obligatoire.",
            'date_heure.required' => 'La date et l\'heure sont obligatoires.',
            'date_heure.date'     => 'La date et l\'heure doivent être valides.',
            'resultat.required'   => 'Le résultat est obligatoire.',
        ];
    }
}
