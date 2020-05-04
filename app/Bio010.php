<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bio010 extends Model
{
    protected $table = 'bio_010';


    public function user(){
    	return $this->belongsTo(User::class);
    }
}
