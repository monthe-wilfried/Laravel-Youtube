<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    //
    public function vote(Video $video, $type){
        return Auth::user()->toggleVote($video, $type);
    }
}
