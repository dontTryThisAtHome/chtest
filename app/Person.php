<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Person extends Model
{
	protected $appends = [ 'deptRelations'];

    public function departments()
    {
    	return $this->belongsToMany(\App\Department::class);
    }


    protected $guarded = [];

    public function getDeptRelationsAttribute()
    {
        $departments = \App\Department::where('active',true)->get()->pluck('id');
        foreach ($departments as  $deptId) {
            if ($this->departments->contains('id', $deptId)) $deptRelations[$deptId] = '&#10003;';
            else $deptRelations[$deptId] = ' ';
        }
        return collect($deptRelations);   
    }
    public function setDepartmentsAttribute($value)
    {
        $this->departments()->detach();
        $this->departments()->attach($value);
    }
}
