<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lowongan extends Model
{
    protected $fillable = [
        'id_mitra',
        'id_type',
        'id_jenjang',
        'id_keahlian',
        'job',
        'keterangan',
    ];

    public function mitra() : BelongsTo{
        return $this->belongsTo(User::class, 'id_mitra');
    }

    public function type() : BelongsTo{
        return $this->belongsTo(Type::class, 'id_type');
    }

    public function jenjang() : BelongsTo{
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }

    public function keahlian() : BelongsTo{
        return $this->belongsTo(Keahlian::class, 'id_keahlian');
    }

    public function lamaran(){
        return $this->hasMany(Lamaran::class, 'id_lowongan');
    }
}
