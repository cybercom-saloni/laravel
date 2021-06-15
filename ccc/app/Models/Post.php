<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    use HasFactory;
    protected $table ='posts';
    public function getCommentId()
    {
        //one to many
        // return $this->hasMany(Comment::class);

        //one to one
        // return $this->hasOne(Comment::class);

        //MANY TO many
        // return $this->belongsToMany(Comment::class);
        //Defining Specific table
        // return $this->belongsToMany(Comment::class,'comments');
        
        //pivoit connect two tables
        return $this->belongsToMany(Comment::class)
                ->wherePivot('status', 1);
        //hasOneThrough
        // return $this->hasOneThrough(Comment_post::class,Comment::class);

        //hasManyThrough
        // return $this->hasManyThrough(Comment_post::class,Comment::class);
    }


}
