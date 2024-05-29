<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\Authentication\User;

class Departemen extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_departement';

    protected $fillable     = [
        'site_id',
        'name',
        'pic',
        'description',
    ];

    public function person(){
    	return $this->belongsTo(User::class, 'pic');
    }
    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
}
