<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    // public function getPostId()
    // {
    //     // return $this->belongsTo(Post::class,'post_id','id');
    //     // return $this->belongsTo(Post::class);
    // }
    public function comments()
    {
        return $this->morphOne(Comment_post::class,'commentable');
    }
}
