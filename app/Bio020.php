<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bio020 extends Model
{
         protected $table = 'bio_020';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
