<?php

use App\Models\Master\Config;
use Illuminate\Database\Seeder;

class SysConfigSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cekData = Config::where('parent','ldap')->get()->first();
        if($cekData){

        }else{
            $data = new Config;
            $data->fill([
                'parent' => 'ldap',
                'status' => 1
            ]);
            $data->save();
        }
    }
}
