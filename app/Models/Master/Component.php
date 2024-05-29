<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class Component extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_component';

    protected $fillable     = [
        'type_id',
        'component',
        'description',
    ];

    public function type(){
    	return $this->belongsTo(TypeEquipment::class, 'type_id');
    }

    public function sub_component(){
        return $this->hasMany(SubComponent::class, 'component_id');
    }
}	
