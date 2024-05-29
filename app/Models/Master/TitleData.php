<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class TitleData extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_title_data';

    protected $fillable     = [
        'name',
        'description',
    ];

}
