<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class SubComponent extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_sub_component';

    protected $fillable     = [
        'type_id',
		'component_id',
		'sub_component',
		'description',
    ];

    public function component(){
        return $this->belongsTo(Component::class, 'component_id');
    }

    public function type(){
        return $this->belongsTo(TypeEquipment::class, 'type_id');
    }
}
