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
  		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      	$permissions = [
        		// ------------- DASHBOARD ---------------
        		[
    				'name'         => 'dashboard',
    				// 'guard_name' => 'Dashboard',
    				'action'       => ['view'],
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
