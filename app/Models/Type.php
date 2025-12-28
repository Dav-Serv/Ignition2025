<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable =[
        'nama'
    ];

    public function lowongan(){
        return $this->hasMany(Lowongan::class, 'id_type');
    }
}
