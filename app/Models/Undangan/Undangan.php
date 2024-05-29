<?php

namespace App\Models\Undangan;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class Undangan extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_undangan';
    protected $fillable 	= [
        'name',
        'no_telp',
        'from',
        'type',
        'count_sender',
    ];
    public function fromLabel()
    {
        switch($this->from)
        {
            case 'male':
                return '<a class="ui black tag label">Laki-laki</a>';
            break;
        }
        return '<a class="ui blue tag label">Perempuan<a>';
    }
    public function countLabel()
    {
        switch($this->count_sender)
        {
            case 1:
                return '<a class="ui black tag label">Sended</a>';
            break;
        }
        return '<a class="ui red tag label">Delay<a>';
    }
}
