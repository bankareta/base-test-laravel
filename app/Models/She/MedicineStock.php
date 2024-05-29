<?php

namespace App\Models\She;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;


class MedicineStock extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_medicine_stock';
    protected $fillable 	= [
        'medicine_id',
        'last_stock',
        'update_stock',
        'number_stock',
        'expire_date',
        'reusable',
    ];
    
    public function setExpireDateAttribute($value)
    {
        $this->attributes['expire_date'] = Helpers::DateToSql($value);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
