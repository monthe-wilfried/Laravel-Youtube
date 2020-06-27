<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Video extends BaseModel
{
    //
    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function editable(){
        if (!Auth::check()) return false;
        return $this->channel->user_id == Auth::id();
    }
}
