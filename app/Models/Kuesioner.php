<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kuesioner extends Model
{
    use HasFactory;

    protected $table = 'kuesioner';
    protected $fillable = ['pertanyaan', 'created_by', 'edited_by'];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function editedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
