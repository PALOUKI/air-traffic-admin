<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passager extends Model
{
    protected $fillable = [
        'vol_id',
        'nom',
        'prenom',
        'dateDeNaissance',
        'nationalite',
        'email'
    ];
    //
    public function vols(){
        return $this->hasMany(Vol::class);
    }
}
