<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        foreach (Permission::all() as $permission) {
            $permission->delete();
        }

        $permissions = [
            'super-admin',
            'user-create',
            'user-edit',
            'user-delete',
            'user-list',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'establishment-list',
            'establishment-create',
            'establishment-edit',
            'establishment-delete',
            'purchase-order-list',
            'purchase-order-create',
            'purchase-order-edit',
            'purchase-order-delete',
            'supplier-list',
            'supplier-create',
            'supplier-edit',
            'supplier-delete',
            'item-list',
            'item-create',
            'item-edit',
            'item-delete',
            'vote-list',
            'vote-create',
            'vote-edit',
            'vote-delete',
            'title-list',
            'title-create',
            'title-edit',
            'title-delete',
            'receive-list',
            'receive-create',
            'receive-edit',
            'receive-delete',
            'issue-list',
            'issue-create',
            'issue-edit',
            'issue-delete',
            'temp-list',
            'temp-create',
            'temp-edit',
            'temp-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
