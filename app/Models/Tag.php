<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'slug','user_id', 'created_at', 'updated_at'];
    protected $table = 'tags';
    protected $primaryKey = 'id';

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
