<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_post extends Model
{

    use HasFactory;
    protected $table = 'comment_post';

    public function commentable()
    {
        return $this->morphTo();
    }
}
