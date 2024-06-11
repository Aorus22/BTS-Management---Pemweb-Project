<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BTS extends Model
{
    use HasFactory;

    protected $table = 'bts';

    protected $fillable = [
        'nama',
        'alamat',
        'id_jenis_bts',
        'latitude',
        'longitude',
        'tinggi_tower',
        'panjang_tanah',
        'lebar_tanah',
        'ada_genset',
        'ada_tembok_batas',
//        'id_user_pic',
        'id_pemilik',
        'id_wilayah',
        'created_by',
        'edited_by',
    ];

    public function jenisBts(): BelongsTo
    {
        return $this->belongsTo(JenisBts::class, 'id_jenis_bts');
    }

    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(Pemilik::class, 'id_pemilik');
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }

//    public function userPic(): BelongsTo
//    {
//        return $this->belongsTo(User::class, 'id_user_pic');
//    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
