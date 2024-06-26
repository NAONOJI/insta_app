<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1; //Admin User
    const USER_ROLE_ID = 2; //Regular User

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Use this to get all the posts of a user
     */
    public function posts(){
        return $this->hasMany(Post::class)->latest();
    }

    /**
     *To get all the followers of a user
     */
    public function followers(){
        return $this->hasMany(Follow::class, 'following_id');
    # to get all the followers, we can select following_id colum
    # from the follow model
    }

    /**
     * Use ths method to get the info of the user being followed
     */
    public function following(){
        return $this->hasMany(Follow::class, 'follower_id');
    }

    /**
     * Use this method to check if the AUTH USER (Logging in user) is already following the user
     */
    public function isFollowed(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        #Auth::user()-->id --- the follower id
        #Firstly, get all the followers of the user ($this->followers()). The, from lists, we search for the Auth User ID from the follower colum ('follower_id', Auth::user()->id) if that exists
    }


}
