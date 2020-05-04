<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mth020 extends Model
{
        protected $table = 'mth_020';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
