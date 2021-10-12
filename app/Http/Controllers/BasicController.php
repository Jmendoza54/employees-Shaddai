<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function checkEmployee($code){
        $employee = Employee::where('code', $code)->first();
        return view('check-employee', ['employee' => $employee, 'card' => '']);
    }
}
