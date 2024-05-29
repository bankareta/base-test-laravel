<?php

namespace App\Models\She;

use Illuminate\Database\Eloquent\Model;

// Traits
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use Helpers;

use App\Models\Authentication\User;
use App\Models\Master\Medicine as MasterMedicine;
use App\Models\Master\RouteMedicine;
use App\Models\Master\Trademark;
use App\Models\Master\UnitMedicine;
use App\Models\Master\Site;


class Medicine extends Model
{
    
    // call traits
    use RaidModel;
    use Utilities;

    protected $table 		= 'trans_medicine';
    protected $fillable 	= [
        'site_id',
        'year',
        'medicine_id',
        'trademark_id',
        'unit_id',
        'dose',
        'min_stock',
        'expire_date',
        'route_id',
        'status'
    ];


    public function setExpireDateAttribute($value)
    {
        $this->attributes['expire_date'] = Helpers::DateToSql($value);
    }
    
    public function site(){
        return $this->belongsTo(Site::class, 'site_id');
    }
    public function stock(){
        return $this->hasMany(MedicineStock::class, 'medicine_id');
    }
    public function medicine(){
        return $this->belongsTo(MasterMedicine::class, 'medicine_id');
    }
    public function trademark(){
        return $this->belongsTo(Trademark::class, 'trademark_id');
    }
    public function route(){
        return $this->belongsTo(RouteMedicine::class, 'route_id');
    }
    public function unit(){
        return $this->belongsTo(UnitMedicine::class, 'unit_id');
    }
    public function statusLabel()
    {
        switch($this->status) {
            case 1 : return 'Sirup';
            break;
            case 0 : return 'Tablet';
            break;
        }
    }
}
