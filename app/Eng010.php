<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eng010 extends Model
{
        protected $table = 'eng_010';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
