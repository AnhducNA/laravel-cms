<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

//use ScoutElastic\Searchable;
class Post extends Model
{
//    php artisan scout:import "App\Models\Post"
    use HasFactory;
    use Searchable;

    // Define the searchable fields for the model
    protected $searchable = [
        'columns' => [
            'title',
            'excerpt',
        ],
    ];

    protected $fillable = ['id', 'title', 'slug', 'description', 'status', 'category_id', 'user_id', 'thumbnail', 'created_at', 'updated_at'];

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize the searchable array

        return $array;
    }

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
