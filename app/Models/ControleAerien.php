<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ControleAerien extends Model
{
    protected $fillable = [
        'vol_id',
        'nom',
        'ville'
    ];
    //
    public function vol(){
        return $this->belongsTo(Vol::class);
    }
}
