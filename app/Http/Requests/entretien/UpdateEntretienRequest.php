<?php

namespace App\Http\Requests\Entretien;

use App\Enums\TypeEntretien;
use App\Enums\ResultatEntretien;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateEntretienRequest extends FormRequest
{
    public function authorize(): bool
    {
        $entretien = $this->route('entretien');
        return $entretien && $entretien->candidature->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'type'              => ['sometimes', 'required', new Enum(TypeEntretien::class)],
            'date_heure'        => ['sometimes', 'required', 'date'],
            'notes_preparation' => ['nullable', 'string', 'max:5000'],
            'resultat'          => ['sometimes', 'required', new Enum(ResultatEntretien::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'       => "Le type d'entretien est obligatoire.",
            'date_heure.required' => 'La date et l\'heure sont obligatoires.',
            'resultat.required'   => 'Le résultat est obligatoire.',
        ];
    }
}
