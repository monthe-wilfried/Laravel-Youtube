<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends BaseModel
{
    //
    public function channel(){
        return $this->belongsTo(Channel::class);
    }
}
