<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    //
    public function vote($entityId, $type){
        $entity = $this->getEntity($entityId);
        return Auth::user()->toggleVote($entity, $type);
    }

    public function getEntity($entityId) {
        $video = Video::find($entityId);
        if ($video) return $video;

        $comment = Comment::find($entityId);
        if ($comment) return $comment;

        throw new ModelNotFoundException('Entity nor found');
    }
}
