<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;

class TypeRegulationsStandard extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_regulations_type';

    protected $fillable     = [
        'type',
        'name',
        'description',
    ];

    public function typeFlag(){
    	if($this){
	    	switch($this->type) {
	            case 0 : return '<a class="ui green tag label">Regulations</a>';
	            break;
	            case 1 : return '<a class="ui blue tag label">Standards</a>';
	            break;
	        }
    	}else{
    		return '';
    	}
    }

    public function typeString(){
        if($this){
            switch($this->type) {
                case 0 : return 'Regulations';
                break;
                case 1 : return 'Standards';
                break;
            }
        }else{
            return '';
        }
    }
}
