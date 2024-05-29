<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;
use App\Libraries\Helpers;

class Contractor extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_contractor';

    protected $fillable     = [
        'company',
        'reference',
        'date',
        'owner',
        'subject',
        'contact_person',
        'email',
        'hp',
        'description',
    ];

}
