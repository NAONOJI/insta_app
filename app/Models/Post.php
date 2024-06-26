<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     *  A post belongs to a user
     * Use this method to get the owner of the post
     */

     public function user(){
        return $this->belongsTo(User::class)->withTrashed();
     }

     /**
      * Use this method to get all the categories under a post
     */

     public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
     }

     /**
      * Use this to get all the comments of a post
      */
      public function comments(){
        return $this->hasMany(Comment::class);
      }

      /**
       * Use this method to get the all the likes of a post
       */
      public function likes(){
        return $this->hasMany(Like::class);
      }

      /**
       * Check if the user already liked th post
       */
      #will return TRUE if the AUTH USER already liked th post
      public function isLiked(){ // true or false
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
      }
}
