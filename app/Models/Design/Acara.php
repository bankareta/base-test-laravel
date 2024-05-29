<?php

namespace App\Models\Design;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class Acara extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_acara';
    protected $fillable 	= [
        'cpp',
        'bpk_cpp',
        'ibu_cpp',
        'status_cpp',
        'cpw',
        'bpk_cpw',
        'ibu_cpw',
        'status_cpw',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'lokasi_maps',
        'wedding_date',
        'title_quotes',
        'quotes',
        'no_rek',
        'bank',
        'no_rek_2',
        'bank_2',
    ];
}
