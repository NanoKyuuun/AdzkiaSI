<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiTermAlias extends Model
{
    use HasFactory;

    public const STATUS_CANDIDATE = 'candidate';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $table = 'ai_term_aliases';

    protected $fillable = [
        'observed_term',
        'canonical_term',
        'category',
        'usage_count',
        'confidence_score',
        'status',
        'source_example',
        'last_seen_at',
    ];

    protected $casts = [
        'usage_count' => 'integer',
        'confidence_score' => 'integer',
        'last_seen_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }
}
