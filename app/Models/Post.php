<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'slug', 'description','status', 'category_id', 'user_id', 'thumbnail', 'created_at', 'updated_at'];
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

    function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
