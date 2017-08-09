<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{	

	protected $appends = [ 'peopleCount', 'maxWage'];
    public function people()
    {
        return $this->belongsToMany(\App\Person::class, 'department_person');
    }

     public function getPeopleCountAttribute()
     {
        return $this->people()->count();
     }

     public function getMaxWageAttribute()
     {
        return $this->people()->max('wage');
     }
   
}
