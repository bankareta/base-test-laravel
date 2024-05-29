<?php

use Illuminate\Database\Seeder;
// use App\Models\Authentication\Role;
// use App\Models\Authentication\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  		// Reset cached roles and permissions
  		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    	// create permissions
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('role_has_permissions')->truncate();
        // DB::table('permissions')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

      	$permissions = [
        		// ------------- DASHBOARD ---------------
        		[
    				'name'         => 'dashboard',
    				// 'guard_name' => 'Dashboard',
    				'action'       => ['view'],
        		],
        		// ------------- MASTER ---------------
        		[
    				'name'         => 'master-pegawai',
    				// 'guard_name' => 'Pegawai',
    				'action'       => ['view', 'add', 'edit', 'delete'],
        		],
        		// ------------- Konfigurasi ---------------
        		[
    				'name'         => 'konfigurasi-users',
    				// 'guard_name' => 'Manajemen Pengguna',
    				'action'       => ['view', 'add', 'edit', 'delete'],
        		],
        		[
    				'name'         => 'konfigurasi-roles',
    				// 'guard_name' => 'Hak Akses',
    				'action'       => ['view', 'add', 'edit', 'delete'],
        		],
      	];

    	foreach ($permissions as $row) {
    		foreach ($row['action'] as $key => $val) {
    			$temp = [
					       'name'         => $row['name'].'-'.$val,
    			];
          $perms = Permission::where('name', $row['name'].'-'.$val)->first();
          if(!$perms)
          {
            Permission::create($temp);
          }
    		}
  		}
      $role = Role::where('name', 'Administrator')->first();

      if(!$role)
      {
        $role = Role::create(['name' => 'Administrator']);
      }
  		$role->givePermissionTo(Permission::all());
    }
}
