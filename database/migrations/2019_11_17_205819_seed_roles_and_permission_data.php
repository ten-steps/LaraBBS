<?php

use App\Models\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SeedRolesAndPermissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 清除緩存，否則會報錯
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        //先創建權限
        Permission::create(['name'=>'manage_contents']);
        Permission::create(['name'=>'manage_users']);
        Permission::create(['name'=>'edit_setting']);

        //創建站長
        $founder =  Role::create(['name'=>'Founder']);
        $founder->givePermissionTo('manage_contents');
        $founder->givePermissionTo('manage_users');
        $founder->givePermissionTo('edit_setting');

        //创建管理员权限，并赋予权限
        $maintainer = Role::create(['name'=>'Maintainer']);
        $maintainer->givePermissionTo('manage_contents');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 清除緩存，否則會報錯
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        //清空所有数据表的数据
        $tableNames = config('permission.table_names');
        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}
