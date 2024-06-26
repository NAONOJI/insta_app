<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Use this method to get te info of the owner of the comment
     * One to Many inverse
     */
    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
}
