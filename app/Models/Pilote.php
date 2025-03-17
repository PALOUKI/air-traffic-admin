<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pilote extends Model
{
    protected $fillable = [
        'compagnie_aerienne_id',
        'nom',
        'prenom',
        'licence'
    ];

    public const LICENCES = [
        'pilote' => 'Pilote',
        'hotesse' => 'Hôtesse',
        'steward' => 'Steward',
        'mecanicien' => 'Mécanicien',
        'agentAuSol' => 'Agent au Sol',
    ];
    //
    public function vols(){
        return $this->hasMany(Vol::class);
    }

    public function compagnieAeriennes(){
        return $this->hasMany(CompagnieAerienne::class);
    }
}
