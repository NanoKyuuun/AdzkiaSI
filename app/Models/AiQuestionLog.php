<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiQuestionLog extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_SUGGESTED = 'suggested';
    public const STATUS_REVIEWED = 'reviewed';
    public const STATUS_PROMOTED = 'promoted';

    protected $table = 'ai_question_logs';

    protected $fillable = [
        'pertanyaan_user',
        'normalized_question',
        'question_hash',
        'jawaban_ai',
        'jumlah',
        'topik_ringkas',
        'kategori_topik',
        'status',
        'faq_id',
        'confidence_score',
        'last_seen_at',
        'suggested_at',
    ];

    protected $casts = [
        'confidence_score' => 'integer',
        'last_seen_at' => 'datetime',
        'suggested_at' => 'datetime',
    ];

    public function faq()
    {
        return $this->belongsTo(Faq::class, 'faq_id');
    }

    public function scopePendingReview($query)
    {
        return $query->whereIn('status', [
            self::STATUS_NEW,
            self::STATUS_SUGGESTED,
        ]);
    }
}
