<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends BaseModel
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
}
