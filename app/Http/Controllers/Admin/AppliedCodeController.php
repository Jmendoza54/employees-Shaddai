<?php

namespace App\Http\Controllers\Admin;

use App\Models\Code;
use App\Traits\MyTraits;
use App\Helpers\MyHelpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AppliedCodeController extends Controller
{
    use MyTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('admin.view-applied-codes');
    }

    public function getAll(){
        $codes = Code::all();

        return datatables()->of($codes)
                ->editColumn('name', function(Code $code){
                    return $code->employee->name.' '.$code->employee->lastname;
                })
                ->editColumn('application_date', function(Code $code){
                    if(!is_null($code->application_date)){
                        return MyHelpers::formatDateEmployee($code->application_date);
                    }
                    

                    return '';
                })
                ->addColumn('status', 'admin.includes.active')
                ->addColumn('actions', 'admin.includes.btn')
                ->rawColumns(['actions', 'status'])
                ->toJson();
    }

    public function getCode(){
        return response()->json([
            'succes' => true,
            'code' => $this->generateCode(8)
        ]);
    }

    public function create(Request $request){
        $newCode = (new Code())->fill($request->all());
        
        $save = $newCode->save();
    
        if($save){
            return response()->json([
                'succes' => true,
                'msg' => 'Agregado correctamente'
            ]);
        }else{
            return response()->json([
                'msg' => 'Error al agregar'
            ]);
        } 
    }

    public function show($id){
        $code = Code::find($id);

        return response()->json([
            'succes' => true,
            'employee' => $code
        ]);
    }

    public function update(Request $request){
        $code = Code::find($request->id);
        $code->employee_id = $request->employee_id;
        $code->status = $request->status;
        $code->total = $request->total;
        $code->sede = $request->sede;
        $code->kind_apply = $request->kind_apply;
        $code->application_date = $request->application_date;
        $code->comments = $request->comments;
        $code->save();

        return response()->json([
            'succes' => true,
            'msg' => 'Actualizado correctamente'
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $code = Code::find($id);

        $code->delete();
            
        return response()->json([
            'succes' => true,
            'msg' => 'Eliminado correctamente'
        ]);
       
       
    }
}
