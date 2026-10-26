<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
     public function Entery()
    {
        return $this->hasMany(Entery::class);
    }
    public function withdraw(){
        return $this->hasMany(Withdraw::class);
    }
}