<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; //This represents the users table

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;

    }

    public function index(){
        #retrieve all the users from users table
        $all_users = $this->user->withTrashed()->latest()->paginate(5); //how many users I will display
        return view('admin.users.index')->with('all_users', $all_users);
    }

    /**
     * Deactivate User
     */
    public function deactivate($id){
        $this->user->destroy($id);
        return redirect()->back();
    }

    /**
     * Activate User
     */
    public function activate($id){
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
