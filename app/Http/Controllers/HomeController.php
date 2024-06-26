<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{

    private $post;
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post =$post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $suggested_users = $this->getSuggestedUsers();
        $home_posts = $this->getHomePosts();
        //Small as: Select * FROM posts ORDER BY created_ at DESC
        return view('users.home')
            ->with('home_posts', $home_posts)
            ->with('suggested_users', $suggested_users);
    }

    /**
     * Get all the post of the users that the AUTH USER (Logged-in user) is following
     */
    public function getHomePosts(){
        $all_posts = $this->post->latest()->get();
        $home_posts = []; // we use this to save the posts here
        // never display a null results. but it should display an empty result

        foreach ($all_posts as $post) {
            if ($post->user->isFollowed() || $post->user->id === Auth::user()->id) {
                $home_posts[] = $post;
            }
        }

        return $home_posts;
    }

    /**
     * Get all the suggested users from the users table
     */
    private function getSuggestedUsers(){
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];
        //this will hold all the suggested users later on
        // The array $suggested_users is initialized as Null just in case the it will not going to have any value

        foreach ($all_users as $user) {
            if( ! $user->isFollowed()){
                $suggested_users[] = $user;
            }
        }

        return array_slice($suggested_users, 0, 5);
        #   $suggested_users[
        #       '0' => 'Test User1',
        #       '1' => 'Test User1',
        #       '2' => 'Test User2',
        #       '3' => 'Test User3',
        #       '4' => 'Test User4',
        #
        #   ]


        #array_slice(x($suggested_users), y(0), Z(5))
        # x -> (0) ---- offset/starting index
        # y -> (5) ---- length / how many to display?
    }

    /**
     * method to search for users
     */
    public function search(Request $request){
        $users = $this->user->where('name', 'like', '%'.$request->search.'%0')->get();
        return view('users.search')
            ->with('users', $users)
            ->with('search', $request->search);
    }
}
