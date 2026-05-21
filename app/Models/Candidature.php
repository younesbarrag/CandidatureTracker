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

    protected $casts = [
        'date_candidature' => 'date',
        'statut' => \App\Enums\StatutCandidature::class,
        'priorite' => \App\Enums\PrioriteCandidature::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entretiens(): HasMany
    {
        return $this->hasMany(Entretien::class);
    }

    /**
     * ACCESSORS
     */

    public function getStatutLabelAttribute(): string
    {
        return $this->statut?->label() ?? (string)$this->statut;
    }

    public function getStatutBadgeAttribute(): string
    {
        return $this->statut?->badgeClass() ?? 'badge-gray';
    }

    public function getPrioriteLabelAttribute(): string
    {
        return $this->priorite?->label() ?? (string)$this->priorite;
    }

    public function getPrioriteBadgeAttribute(): string
    {
        return $this->priorite?->badgeClass() ?? 'badge-gray';
    }

    public function getFichierAttribute()
    {
        return $this->cv_path;
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
