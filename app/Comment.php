<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel
{
    // fetches the comment with the user
    protected  $with = ['user'];

    public function votes(){
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function video(){
        return $this->belongsTo(Video::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }
}
