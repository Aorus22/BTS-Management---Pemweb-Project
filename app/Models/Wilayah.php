<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';
    protected $fillable = ['nama', 'id_parent', 'level', 'created_by', 'edited_by'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class, 'id_parent');
    }
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function editedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
