<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'slug', 'description', 'thumbnail','category_id', 'user_id', 'tag_id', 'created_at', 'updated_at'];
    protected $table = 'posts';
    protected $primaryKey = 'id';

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
