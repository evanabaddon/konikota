<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'event_create',
            ],
            [
                'id'    => 18,
                'title' => 'event_edit',
            ],
            [
                'id'    => 19,
                'title' => 'event_show',
            ],
            [
                'id'    => 20,
                'title' => 'event_delete',
            ],
            [
                'id'    => 21,
                'title' => 'event_access',
            ],
            [
                'id'    => 22,
                'title' => 'cabor_create',
            ],
            [
                'id'    => 23,
                'title' => 'cabor_edit',
            ],
            [
                'id'    => 24,
                'title' => 'cabor_show',
            ],
            [
                'id'    => 25,
                'title' => 'cabor_delete',
            ],
            [
                'id'    => 26,
                'title' => 'cabor_access',
            ],
            [
                'id'    => 27,
                'title' => 'venue_create',
            ],
            [
                'id'    => 28,
                'title' => 'venue_edit',
            ],
            [
                'id'    => 29,
                'title' => 'venue_show',
            ],
            [
                'id'    => 30,
                'title' => 'venue_delete',
            ],
            [
                'id'    => 31,
                'title' => 'venue_access',
            ],
            [
                'id'    => 32,
                'title' => 'pertandingan_create',
            ],
            [
                'id'    => 33,
                'title' => 'pertandingan_edit',
            ],
            [
                'id'    => 34,
                'title' => 'pertandingan_show',
            ],
            [
                'id'    => 35,
                'title' => 'pertandingan_delete',
            ],
            [
                'id'    => 36,
                'title' => 'pertandingan_access',
            ],
            [
                'id'    => 37,
                'title' => 'atlet_create',
            ],
            [
                'id'    => 38,
                'title' => 'atlet_edit',
            ],
            [
                'id'    => 39,
                'title' => 'atlet_show',
            ],
            [
                'id'    => 40,
                'title' => 'atlet_delete',
            ],
            [
                'id'    => 41,
                'title' => 'atlet_access',
            ],
            [
                'id'    => 42,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
