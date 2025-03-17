<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aeroport extends Model
{
    //
    protected $fillable =[
        'nom',
        'ville',
        'pays',
        'latitude',
        'longitude'
    ];

    public function vols(){
       return $this->hasMany(Vol::class);
    }
}
