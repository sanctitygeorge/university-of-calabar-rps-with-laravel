<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chm020 extends Model
{
        protected $table = 'chm_020';
    
    
        public function user(){
            return $this->belongsTo(User::class);
        }
}
