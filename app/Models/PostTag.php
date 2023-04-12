<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'post_id', 'tag_id'];
    protected $table = 'post_tag';
    protected $primaryKey = 'id';

    function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
