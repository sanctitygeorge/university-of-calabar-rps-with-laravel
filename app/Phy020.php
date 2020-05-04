<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phy020 extends Model
{
        protected $table = 'phy_020';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
