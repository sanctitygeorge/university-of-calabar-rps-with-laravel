<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mth010 extends Model
{
        protected $table = 'mth_010';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
