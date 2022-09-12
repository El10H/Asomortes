<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class beneficiary extends Model
{

    protected $guarded = []; 
    public function partner(){
        return $this->belongsTo(partner::class);
    }
}
