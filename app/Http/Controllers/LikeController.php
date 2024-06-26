<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Like; #represent the likes table

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like){
        $this->like = $like;
    }

    #to store the like action into likes table

    public function store($post_id){
        $this->like->user_id = Auth::user()->id;
        $this->like->post_id = $post_id;
        $this->like->save();
        #Same as 'INSERT INTO LIKES(user_id, --)'

        return redirect()->back();
    }

    public function destroy($post_id){
        $this->like
            ->where('user_id', Auth::user()->id) // owner of the  like
            ->where('post_id', $post_id) //the post id being liked
            ->delete();

            #Same as: DELETE FROM likes WHERE user_id = Auth::user()->id  && post_id = $post_id

        return redirect()->back();

    }
}

