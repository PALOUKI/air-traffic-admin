<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CompagnieAerienne extends Model
{
    //

    protected $fillable = [
        'nom',
        'pays',
    ];

    public function vols(){
        return $this->hasMany(Vol::class);
    }

    public function avions(){
        return $this->hasMany(Avion::class);
    }

    public function personnels(){
        return $this->hasMany(Personnel::class);
    }

    public function pilotes(){
        return $this->hasMany(Pilote::class);
    }
}
