<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class TypeProject extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_type_project';

    protected $fillable     = [
        'name',
        'description',
    ];

}
