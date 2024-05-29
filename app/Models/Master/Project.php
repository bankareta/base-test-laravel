<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class Project extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_project';

    protected $fillable     = [
        'project',
        'project_number',
        'type_project',
    ];

    public function type(){
    	return $this->belongsTo(TypeProject::class, 'type_project');
    }
}
