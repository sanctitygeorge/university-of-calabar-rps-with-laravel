<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phy010 extends Model
{
        protected $table = 'phy_010';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
