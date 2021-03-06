<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $guarded = ['id'];

    public function codes(){
        return $this->hasMany(Code::class, 'employee_id');
    }
}
