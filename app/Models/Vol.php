<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vol extends Model
{
    protected $fillable = [
        'compagnie_aerienne_id',
        'aeroport_id',
        'avion_id',
        'dateHeureDepart',
        'dateHeureArrivee',
        'dureeEstimee',
        'statut',
    ];

    public const STATUSES = [
        'programmer' => 'Programmmé',
        'retarder' => 'Retardé',
        'enVol' => 'En vol',
        'atterri' => 'Atterri',
        'devier' => 'Devié',
    ];


    public function compagnieAerienne(){
        return $this->belongsTo(CompagnieAerienne::class);
    }

    public function aeroport(){
        return $this->belongsTo(Aeroport::class);
    }
    public function avion(){
        return $this->belongsTo(Avion::class);
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
}
