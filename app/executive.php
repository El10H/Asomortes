<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class executive extends Model
{
    protected $guarded = []; 

    public function partner(){
        return $this->belongsTo(partner::class);
    }
}
