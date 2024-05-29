<?php

use Illuminate\Database\Seeder;

use App\Models\Authentication\User;
use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    public function run()
    {
    	$role_admin = Role::findByName('Administrator');
    	// create user
  		$cekUsers = User::where('email','administrator@gmail.com')->first();
  		if(isset($cekUsers)){
  			$users = User::find($cekUsers->id);
  			$users->delete();
  		}
  		$admin = new User();
  		$admin->username   = 'administrator';
  		$admin->password   = bcrypt('password');
  		$admin->email   = 'administrator@gmail.com';
  		$admin->last_login = date('Y-m-d H:i:s');
  		$admin->save();
  		$admin->assignRole($role_admin);
      }
}
