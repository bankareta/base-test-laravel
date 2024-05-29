<?php

namespace App\Models\Planning;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class SeserahanList extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_seserahan_list';
    protected $fillable 	= [
        'type',
        'name',
        'merk',
        'qty',
        'link',
        'desc',
        'plan_budget',
        'real_budget',
        'status',
    ];

    public function statusLabel()
    {
        switch($this->real_budget)
        {
            case 0:
                return '<a class="ui red tag label">Belum</a>';
            break;
        }
        return '<a class="ui black tag label">Lunas<a>';
    }
}
