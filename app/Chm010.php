<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chm010 extends Model
{
        protected $table = 'chm_010';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
