<?php

namespace Database\Seeders;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        Tag::create(['id' => 1, 'name' => 'ngân hàng', 'slug' => 'xa-hoi', 'user_id'=>1, 'created_at'=>$now]);
        Tag::create(['id' => 2, 'name' => 'bất động sản', 'slug' => 'bat-dong-san', 'user_id'=>5, 'created_at'=>$now]);
        Tag::create(['id' => 3, 'name' => 'nhà đất', 'slug' => 'nha-dat', 'user_id'=>5, 'created_at'=>$now]);
    }
}
