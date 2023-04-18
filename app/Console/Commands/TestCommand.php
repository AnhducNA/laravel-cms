<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class TestCommand extends Command
{
protected $signature = "test";
    public function handle(): void
    {
        Post::whereIn('category_id', [34, 35, 36, 37, 38, 39, 40])->delete();
    }
}
