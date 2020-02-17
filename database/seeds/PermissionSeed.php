<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $items = [
            [
                'name' => 'users_manage',
            ],
            [
                'name' => 'roles_manage',
            ],
            [
                'name' => 'permissions_manage'
            ]
        ];

        Permission::insert($items);
    }
}
