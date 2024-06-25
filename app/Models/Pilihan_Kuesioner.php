<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pilihan_Kuesioner extends Model
{
    use HasFactory;

    protected $table = 'pilihan_kuesioner';
    protected $fillable = ['id_kuesioner', 'pilihan_jawaban' , 'created_by', 'edited_by'];

    public function kuesioner(): BelongsTo
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner');
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
