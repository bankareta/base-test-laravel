<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class DImg extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_dashboard_img';

    protected $fillable     = [
      'filename',
      'url',
      'base_url',
      'type',
      'description',
      'position'
    ];
}	
