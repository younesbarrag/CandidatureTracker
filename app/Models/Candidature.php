<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Candidature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'entreprise',
        'poste',
        'url_offre',
        'statut',
        'priorite',
        'notes',
        'date_candidature',
        'cv_path',

    ];

    protected $casts =[
        'date_candidateur'=> 'date',
        'created_at'=>'datetime',
        'update_at'=>'datetime',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   public function entretiens(): HasMany
    {
        return $this->hasMany(Entretien::class);
    }


    public function getStatutFrancaisAttribute()
    {
        $statuts = [
            'candidature_envoyee'=>'Candidature envoyee',
            'en_attente'=>'En attente',
            'entretien_planifie'=>'Entretien planifie',
            'offre_recue'=>'Offre recue',
            'refusee'=>'Refusee',
            'abandonnee'=> 'Abandonnee',
];

return $statuts [$this->statuts]??$this->statuts;
    }
     public function getPrioriteLabelAttribute()
    {
        $priorites = [
            'haute' => ' Haute',
            'moyenne' => ' Moyenne',
            'basse' => ' Basse',
        ];

        return $priorites[$this->priorite] ?? $this->priorite;
    }

    /**
     * SCOPES
     */

    public function scopeByStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    public function scopeByPriorite($query, $priorite)
    {
        return $query->where('priorite', $priorite);
    }

    public function scopeArchived($query)
    {
        return $query->onlyTrashed();
    }
}
