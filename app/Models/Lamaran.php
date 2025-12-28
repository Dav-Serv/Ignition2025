<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lamaran extends Model
{
    protected $fillable = [
        'id_lowongan',
        'id_pengguna',
        'cv',
        'status',
    ];

    public function lowongan() : BelongsTo{
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }

    public function pengguna() : BelongsTo{
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}
