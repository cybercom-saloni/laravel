<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    use HasFactory;
    protected $table ='posts';
    public function comments()
    {
        return $this->morphOne(Comment_post::class,'commentable');
        // return $this->morphMany(Comment_post::class,'commentable');

    }
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
        // return $this->belongsToMany(Comment::class)
        //         ->wherePivot('status', 1);
        // return $this->belongsToMany(Comment::class)
        //         ->wherePivotIn('status', [1,2]);
        // return $this->belongsToMany(Comment::class)
        //         ->as('comments')
        //         ->wherePivotBetween('created_at', ['2020-01-01 00:00:00', '2020-12-31 00:00:00']);

            // return $this->belongsToMany(Comment::class)
            //                 ->as('comments')
            //                 ->wherePivotNotBetween('created_at', ['2020-01-01 00:00:00', '2020-12-31 00:00:00']);

            // return $this->belongsToMany(Comment::class)
            //                 ->as('comments')
            //                 ->wherePivotNull('updated_at');

            // return $this->belongsToMany(Comment::class)
            //                 ->as('comments')
            //                 ->wherePivotNotNull('updated_at');
        //hasOneThrough
        // return $this->hasOneThrough(Comment_post::class,Comment::class);

        //hasManyThrough
        // return $this->hasManyThrough(Comment_post::class,Comment::class);
    }


}
