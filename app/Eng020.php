<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eng020 extends Model
{
        protected $table = 'eng_020';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
