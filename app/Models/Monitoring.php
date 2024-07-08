<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';

    protected $fillable = [
        'tahun',
        'id_bts',
        'tanggal_kunjungan',
        'created_by',
        'edited_by'
    ];

    public function bts(): BelongsTo
    {
        return $this->belongsTo(BTS::class, 'id_bts');
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
