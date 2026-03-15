<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    protected $fillable = [
        'form_entry_id',
        'filename',
        'filepath',
    ];

    /**
     * The FormEntry this file belongs to.
     */
    public function formEntry(): BelongsTo
    {
        return $this->belongsTo(FormEntry::class);
    }
}