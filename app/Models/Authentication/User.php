<?php

namespace App\Models\Authentication;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// entrust
// use Zizaco\Entrust\Traits\EntrustUserTrait;
use Spatie\Permission\Traits\HasRoles;
// Models
use App\Models\Master\Karyawan;
use App\Models\Master\Site;
use App\Models\Project\Project;
use App\Models\Project\Task;
use App\Models\Traits\Utilities;
use App\Models\Master\Bulletin;
use App\Models\Master\Policy;
use App\Models\Accident\Report;
use App\Models\Regulation\Regulations;

use Carbon;
use Helpers;

use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Utilities;
    use Notifiable;
    // use EntrustUserTrait;
    use HasRoles;

    public $table = 'sys_users';
    public $remember_token = false;

    protected $guard_name = 'web';
    protected $dates = ['last_login', 'birthdate'];
    protected $fillable = [
      'username', 'password', 'email', 'last_login', 'birthdate', 'fullname', 'address', 'gender','status','position'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setBirthdateAttribute($value = '')
    {
      $this->attributes["birthdate"] = Helpers::DateToSql($value);
    }

    public function showfotopath()
    {
        if($this->fotopath)
        {
            return asset('storage/'.$this->fotopath);
        }

        return asset('img/no-images.png');
    }
    public function showroles()
    {
        if($this->roles)
        {
            if($this->roles->first())
            {
              return $this->roles->first()->name;
            }
        }

        return 'Roles not set';
    }

    public function scopeHasAccess($query)
    {
        return $query->whereHas('roles', function ($query) {
              $query->has('permissions');
        });
    }

    public function scopePermission($query, $permissions)
    {
        if ($permissions instanceof Collection)
        {
            $permissions = $permissions->toArray();
        }

        $perms = Permission::whereIn('name', [$permissions])->get();

        if($perms->count() > 0)
        {
            if (!is_array($permissions))
            {
                $permissions = [$permissions];
            }
            $permissions = array_map(function ($permission) {
                if ($permission instanceof Permission) {
                    return $permission;
                }
                return app(Permission::class)->findByName($permission);
            }, $permissions);

            return $query->whereHas('roles', function ($query) use ($permissions) {
                $query->whereHas('permissions', function ($query) use ($permissions) {
                    $query->where(function ($query) use ($permissions) {
                        foreach ($permissions as $permission) {
                            $query->orWhere(config('permission.table_names.permissions').'.id', $permission->id);
                        }
                    });
                });
            });
        }

        return $query->where('id', NULL);
    }

    public function updateActivity()
    {
        $this->last_activity = Carbon::now()->format('Y-m-d H:i:s');
        $this->save();
    }

    public function flushActivity()
    {
        $this->last_activity = NULL;
        $this->save();
    }

    /* End Custom Function */
}
