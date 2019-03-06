<?php

use Illuminate\Database\Seeder;

class PermissionsRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions_roles')->delete();
        DB::table('permissions_roles')->insert(
            [
                [
                    'permission_id' => \Apps\User\Model\Permission::where(
                        'permission', 'Admin-users')->first()['id'],
                    'role_id' => \Apps\User\Model\Role::where(
                        'role', 'Admin')->first()['id'],
                ],
                [
                    'permission_id' => \Apps\User\Model\Permission::where(
                        'permission', 'Seller-users')->first()['id'],
                    'role_id' => \Apps\User\Model\Role::where(
                        'role', 'Seller')->first()['id'],
                ],
                [
                    'permission_id' => \Apps\User\Model\Permission::where(
                        'permission', 'Customer-users')->first()['id'],
                    'role_id' => \Apps\User\Model\Role::where(
                        'role', 'Customer')->first()['id'],
                ]
            ]
        );
    }
}
