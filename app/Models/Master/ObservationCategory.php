<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\User;
use Carbon;

class ObservationCategory extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_observation_category';

    protected $fillable     = [
        'name',
        'position',
    ];
  
    public function component(){
    	return $this->hasMany(ObservationCategoryDetail::class, 'observation_category_id');
    }

    public function saveComponent($id,$component,$param = null){
        foreach($component->component as $key => $val){
            if ($val) {
                if($param){
                    if(isset($component->component_id[$key])){
                        $save = ObservationCategoryDetail::find($component->component_id[$key]);
                        $add['observation_category_id'] = $id;
                        $add['desc'] = $val;
                        $add['abbreviation'] = $component->abbreviation[$key];
                        $save->fill($add);
                        $save->save();
                        $check_id[$key] = $save->id;
                    }else{
                        $save = new ObservationCategoryDetail;
                        $add['observation_category_id'] = $id;
                        $add['desc'] = $val;
                        $add['abbreviation'] = $component->abbreviation[$key];
                        $save->fill($add);
                        $save->save();
                        $check_id[$key] = $save->id;
                    }
                }else{
                    $save = new ObservationCategoryDetail;
                    $add['observation_category_id'] = $id;
                    $add['desc'] = $val;
                    $add['abbreviation'] = $component->abbreviation[$key];
                    $save->fill($add);
                    $save->save();
                }
            }
        }
        if($param){
            $check = ObservationCategoryDetail::with('freshEyeDetail')->where('observation_category_id',$id)->whereNotIn('id',$check_id);
            if($check->get()->count() > 0){
                foreach ($check->get() as $key => $value) {
                   $deleted = ObservationCategoryDetail::find($value->id);
                   if($deleted->freshEyeDetail->count() == 0){
                       $deleted->delete();
                   }else{
                        return 'false';
                   }
                }
            }
        }
    }
}
