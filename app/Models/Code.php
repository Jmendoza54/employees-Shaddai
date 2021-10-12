<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'applied_codes';
    protected $guarded = ['id'];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
