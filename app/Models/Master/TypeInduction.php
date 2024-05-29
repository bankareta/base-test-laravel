<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class TypeInduction extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_induction_type';

    protected $fillable     = [
        'name',
    ];

}
