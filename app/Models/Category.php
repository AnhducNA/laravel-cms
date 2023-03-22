<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'slug', 'user_id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    protected $table = 'categories';

    function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
