<?php
namespace App\Models\Authentication;

use App\Models\Traits\Utilities;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\RaidModel;

class Role extends Model
{
    use Utilities;
    use RaidModel;

    public $table = 'roles';
    protected $fillable = [
     'name'
    ];

    public function creator()
    {
        $this->belongsTo(User::class, 'created_by');
    }

}
