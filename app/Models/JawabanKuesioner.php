<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanKuesioner extends Model
{
    use HasFactory;

    protected $table = 'jawaban_kuesioner';
    protected $fillable = ['id_monitoring', 'id_kuesioner' , 'id_pilihan_kuesioner', 'created_by',  'edited_by'];

    public function monitoring(): BelongsTo
    {
        return $this->belongsTo(Monitoring::class, 'id_monitoring');
    }
    public function kuesioner(): BelongsTo
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner');
    }
    public function pilihanjawaban(): BelongsTo
    {
        return $this->belongsTo(Pilihan_Kuesioner::class, 'id_pilihan_kuesioner');
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
