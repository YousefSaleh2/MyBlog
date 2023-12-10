<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            '',
            'index',

            'tables',

            'categories',
            'categories_index ',
            'category_create',
            'category_edit',
            'category_show',
            'category_delete',
            'categories_show_deleted',
            'category_restore',
            'category_force_delete',

            'posts',
            'posts_index ',
            'post_create',
            'post_edit',
            'post_show',
            'post_delete',
            'posts_show_deleted',
            'post_restore',
            'post_force_delete',

            'users',

            'users_index ',
            'user_create',
            'user_edit',
            'user_show',
            'user_delet',

            'user_permissions',
            'user_permissions_create',
            'user_permissions_edit',
            'user_permissions_show',
            'user_permissions_delete',

            'setting'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
