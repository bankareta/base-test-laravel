<?php

namespace App\Models\Planning;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class WeddingList extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_wedding_list';
    protected $fillable 	= [
        'name',
        'qty',
        'vendor',
        'plan_budget',
        'real_budget',
        'dp',
        'debt',
        'status',
    ];

    public function child(){
        return $this->hasMany(WeddingListDetail::class, 'wedding_list_id');
    }
    public function statusLabel()
    {
        switch($this->status)
        {
            case 1:
                return '<a class="ui black tag label">Lunas<a>';
            break;
            case 0:
                return '<a class="ui red tag label">Belum</a>';
            break;
        }
    }
}
