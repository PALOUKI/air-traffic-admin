<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{

    protected $fillable = [
        'compagnie_aerienne_id',
        'modele',
        'capacite',
        'anneeDeFrabrication',
    ];
    //
    public function vols(){
        return $this->hasMany(Vol::class);
    }

    public function controleAeriens(){
        return $this->hasMany(ControleAerien::class);
    }

    public function passagers(){
        return $this->hasMany(Passager::class);
    }
    public function pilotes(){
        return $this->hasMany(Pilote::class);
    }

    public function compagnieAerienne(){
        return $this->belongsTo(CompagnieAerienne::class);
    }

}
