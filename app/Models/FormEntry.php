<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormEntry extends Model
{
    // Allow mass assignment on these fields
    protected $fillable = [
        'user_id',
        'checked_unit',
        'years_of_review',
        'found',
        'order',
        'excellent_goods',
        'remaining_items',
        'guidance_corrective_and_advisory',
        'disciplinary',
        'refund_amount',
        'achieved',
        'remaining',
        'follow_up_letter_number_1',
        'follow_up_letter_number_2',
        'follow_up_letter_number_3',
        'written_confirmation_number_of_compliance',
        'done_not_done',
        'reason_for_non_compliance',
        'responsible_department',
        'considerations',
    ];

    // Optional casting for refund_amount and done_not_done enum
    protected $casts = [
        'refund_amount' => 'decimal:2',
        'done_not_done' => 'string',  // Could also use enum casts with Laravel 9+
    ];

    /**
     * The user who created the form entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The files associated with this form entry.
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}