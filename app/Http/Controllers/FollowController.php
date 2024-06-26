<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow){
        $this->follow = $follow;
    }

    /**
     * to store the follower id , and the user being followed
     */
    public function store($user_id){
        $this->follow->follower_id = Auth::user()->id; //the id of the follower
        $this->follow->following_id = $user_id; //the id of the user being followed
        $this->follow->save();
        //same asa INSERT

        return redirect()->back();
    }

    /**
     * DESTROY / unfollow
     */
    public function destroy($user_id){
        $this->follow
            ->where('follower_id', Auth::user()->id) //the follower to delete
            ->where('following_id', $user_id) //the user being followed -- to delete
            ->delete();

            return redirect()->back();
    }


}
