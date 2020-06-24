<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Channel $channel)
    {
        return $channel->subscriptions()->create([
            'user_id' => Auth::id()
        ]);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Channel $channel, Subscription $subscription)
    {
        $subscription->delete();

        return response()->json([]);
    }
}
