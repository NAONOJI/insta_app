<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post){
        $this->post = $post;
    }

    public function index(){

        $all_posts = $this->post->withTrashed()->latest()->paginate(7);
        return view('admin.posts.index')->with('all_posts', $all_posts);
    }

    /**
     * This method hides the post
     */
    public function hide($id){
        $this->post->destroy($id);
        return redirect()->back();
    }

    /**
     * unhide the posts that have been soft deleted
     */
    public function unhide($id){
        $this->post->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
