<?php
namespace App\Models\Traits;

use App\Models\Authentication\User;
use DB;

trait RaidModel
{
    public static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            if (\Schema::hasColumn(with(new static )->getTable(), 'updated_by')) {
                static::saving(function ($table) {
                    $table->updated_by = auth()->user()->id;
                });
            }

            if (\Schema::hasColumn(with(new static )->getTable(), 'created_by')) {
                static::creating(function ($table) {
                    $table->updated_by = null;
                    $table->updated_at = null;
                    $table->created_by = auth()->user()->id;
                });
            }
        }

        // insert to log
        if($log_table = (new static)->log_table){
            static::saved(function ($table) {
                $log = $table->attributes;
                $log[$table->log_table_fk] = $log['id'];
                unset($log['id']);

                DB::table($table->log_table)->insert($log);
            });

            static::deleting(function ($table) {
                $log = $table->attributes;
                $log[$table->log_table_fk] = $log['id'];
                unset($log['id']);

                DB::table($table->log_table)->insert($log);
            });
        }
    }

    /*-----------*/
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function entryBy()
    {
        return isset($this->creator) ? (isset($this->creator->display) ? $this->creator->display : $this->creator->username) : '[System]';
    }

    public function creatorGrid()
    {
        return '<i class="user icon"></i>' . isset($this->creator) ? (isset($this->creator->display) ? $this->creator->display : $this->creator->username) : '[System]';
        
    }

    public function creationGrid()
    {
        return is_null($this->created_at)
             ? '<i class="calendar icon"></i> ? &nbsp; <i class="clock icon"></i> ?'
             : '<i class="calendar icon"></i>' . $this->created_at->format('d/m/Y') . '&nbsp; <i class="clock icon"></i>' . $this->created_at->format('H:i');
    }

    /* save data */
    public static function saveData($request, $identifier = 'id')
    {
        $record = static::prepare($request, $identifier);
        $record->fill($request->all());
        $record->save();

        return $record;
    }

    public static function prepare($request, $identifier = 'id')
    {
        $record = new static;

        if ($request->has($identifier) && $request->get($identifier) != null && $request->get($identifier) != 0) {
            $record = static::find($request->get($identifier));
        }

        return $record;
    }

}
