<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entretien extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Table fields allowed for mass assignment
     */
    protected $fillable = [
        'candidature_id',
        'type',
        'date_heure',
        'lieu',
        'notes_preparation',
        'resultat',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'date_heure' => 'datetime',
        'type' => \App\Enums\TypeEntretien::class,
        'resultat' => \App\Enums\ResultatEntretien::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * RELATIONS
     */

    // 🔗 Un entretien appartient à une candidature
    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }

    /**
     * ACCESSORS (read-friendly labels)
     */

    public function getTypeLabelAttribute(): string
    {
        return $this->type?->label() ?? (string)$this->type;
    }

    public function getResultatLabelAttribute(): string
    {
        return $this->resultat?->label() ?? (string)$this->resultat;
    }

    public function getResultatBadgeAttribute(): string
    {
        return $this->resultat?->badgeClass() ?? 'badge-gray';
    }

    /**
     * SCOPES (optional but pro)
     */

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByResultat($query, $resultat)
    {
        return $query->where('resultat', $resultat);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date_heure', '>=', now());
    }
}