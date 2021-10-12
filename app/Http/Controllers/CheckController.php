<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Carbon\Carbon;
use App\Models\Employee;
use App\Traits\MyTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;

class CheckController extends Controller
{
    use MyTraits;

    public function checkEmployee($code){
        $employee = Employee::where('code', $code)->first();

        if($employee->status == 1){
            $newCode = new Code;
            $newCode->employee_id = $employee->id;
            $newCode->code = $this->generateCode(8);
            $newCode->save();
        }
        
        return view('check-employee', ['employee' => $employee]);
    }

    public function downCardEmployee($code){
        $employee = Employee::where('code', $code)->first();
        return view('check-employee', ['employee' => $employee]);
    }

    public function applyCode(Request $request){
        $codeReq = $request->code;
        $code = Code::where('code', $codeReq)->first();
        if(empty($code)){
            $msg = 'Este Código no existe';
        }else{
            $lastCode = $code->employee->codes->last()->code;
            $status = $code->employee->codes->last()->status;

            if($lastCode == $request->code && $status == 0){
                $code->total = $request->total;
                $code->sede = $request->sede;
                $code->kind_apply = $request->kind_apply;
                $code->application_date = Carbon::now()->isoFormat('Y-MM-DD');
                $code->status = 1;
                $code->save();
                $msg = 'Código aplicado';
            }else{
                $msg = 'Código Expirado o usado';
            } 
        }
       
        return response()->json([
            'succes' => true,
            'msg' => $msg
        ]);
    }

    public function confirmPassword($code){
        $cookie = Cookie::get('check-employee');
        $token = Token::find(1);

        if($cookie != null && $cookie == $token->remember_token){
            return redirect()->route('check.employee', ['code' => $code]);
        }else{
            $codeEmp = Employee::where('code', $code)->first();

            if(empty($codeEmp)){
                return view('form-confirm-password', ['msg' => 'Este Código no existe']);
            }else{
                return view('form-confirm-password', ['code' => $code]);
            }
        }
    }

    public function verifyPassword(Request $request){
        
        $token = Token::find(1);
        
        if(Hash::check($request->password, $token->password)){
            Cookie::queue(Cookie::make('check-employee', $token->remember_token, 60));
            $url = route('check.employee', ['code' => $request->code]);

            return response()->json([
                'succes' => true,
                'url' => $url
            ]);
        }else{
            return response()->json([
                'succes' => false,
                'msg' => 'Password Incorrecto'
            ]);
        }
    }
}
