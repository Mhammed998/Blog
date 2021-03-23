<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table="comments";

    protected $fillable=['user_id','post_id','comment','parent_id','status'];

    //relationships here:

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }






}
