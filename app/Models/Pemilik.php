<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find($id)
 * @method static findOrFail($id)
 * @method static create(array $data)
 */
class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $fillable = ['nama', 'alamat', 'telepon', 'created_by', 'edited_by'];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function editedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
