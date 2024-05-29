<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\Authentication\User;

class AuditType extends Model
{
    // call traits
    use RaidModel;
    use Utilities;

    protected $table        = 'ref_audit_type';

    protected $fillable     = [
        'name',
        'description',
    ];

}