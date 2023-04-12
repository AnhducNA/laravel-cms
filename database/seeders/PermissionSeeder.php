<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        Permission::create(['name' => 'manage_all']);
        Permission::create(['name' => 'manage_user']);
        Permission::create(['name' => 'manage_article']);
        Permission::create(['name' => 'manage_category']);
        Permission::create(['name' => 'manage_tag']);

        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user_admin']);
        Role::create(['name' => 'article_admin']);
        Role::create(['name' => 'category_admin']);
        Role::create(['name' => 'tag_admin']);

        // Assign permissions to roles
        Role::findByName('admin')->givePermissionTo('manage_all');
        Role::findByName('user_admin')->givePermissionTo('manage_user');
        Role::findByName('article_admin')->givePermissionTo('manage_article');
        Role::findByName('category_admin')->givePermissionTo('manage_category');
        Role::findByName('tag_admin')->givePermissionTo('manage_tag');

        User::find(1)->assignRole('admin');

    }
}
