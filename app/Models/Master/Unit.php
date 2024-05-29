<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class Unit extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_unit';

    protected $fillable     = [
        'name',
        'description',
    ];

   
}	
