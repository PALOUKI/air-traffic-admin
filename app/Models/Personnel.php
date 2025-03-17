<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $fillable = [
        'compagnie_aerienne_id',
        'nom',
        'prenom',
        'fonction'
    ];

    public const FONCTIONS = [
        'pilote' => 'Pilote',
        'hotesse' => 'Hôtesse',
        'steward' => 'Steward',
        'mecanicien' => 'Mécanicien',
        'agentAuSol' => 'Agent au Sol',
    ];

   /* 
   public const FONCTIONS = [
        'Pilote' => 'pilote',
        'Hôtesse' => 'hotesse',
        'Steward' => 'steward',
        'Mécanicien' => 'mecanicien',
        'Agent au Sol' => 'agentAuSol',
    ];
    */
    public function compagnieAerienne(){
        return $this->belongsTo(CompagnieAerienne::class);
    }
}
