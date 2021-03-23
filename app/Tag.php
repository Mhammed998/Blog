<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table="tags";
    protected $fillable=['name','link'];





    //relationship here:


    public function posts(){
        return $this->belongsToMany(Post::class,'post_tag');
    }



}
