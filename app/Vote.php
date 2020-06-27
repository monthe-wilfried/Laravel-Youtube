<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends BaseModel
{
    //
    public function voteable(){
        return $this->morphTo();
    }
}
