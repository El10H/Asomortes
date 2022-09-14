<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class partner extends Model
{

    protected $guarded = []; 

    public function Beneficiaries(){
        return $this->hasMany(beneficiary::class);
    }

    public function executive(){
        return $this->belongsTo(executive::class);
    }

    
}