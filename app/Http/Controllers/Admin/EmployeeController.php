<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelpers;
use App\Models\Employee;
use App\Traits\MyTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class EmployeeController extends Controller
{
    use MyTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.view-employees');
    }

    public function tableEmployees(){
        $employees = Employee::all();

        return datatables()->of($employees)
                ->editColumn('name', function(Employee $employee){
                    return $employee->name.' '.$employee->lastname;
                })
                ->editColumn('admission_date', function(Employee $employee){
                    return MyHelpers::formatDateEmployee($employee->admission_date);
                })
                ->editColumn('photo_qr', function(Employee $employee){
                    $url = $this->getUrlImg('qr', $employee->code);
                    return view('admin.includes.url-download', ['url' => $url, 'target' => 'Qr']);
                })
                ->editColumn('photo_employee', function(Employee $employee){
                    $url = $this->getUrlImg('photo', $employee->code);
                    return view('admin.includes.url-download', ['url' => $url, 'target' => 'Perfil']);
                })
                ->addColumn('status', 'admin.includes.active')
                ->addColumn('actions', 'admin.includes.btn')
                ->rawColumns(['actions', 'status'])
                ->toJson();
    }

    public function getEmployees(){
        $employees = Employee::get(['id', 'name', 'lastname']);

        return response()->json([
            'succes' => true,
            'employee' => $employees
        ]);
    }

    public function show($id){
        $employee = Employee::find($id);

        return response()->json([
            'succes' => true,
            'employee' => $employee
        ]);
    }

    public function create(Request $request)
    {
        $newEmployee = (new Employee())->fill($request->all());
        $code = $this->generateCode(6);
        $newEmployee->code = $code;
        $this->createQr($code);

        if($request->hasFile('url_photo')){
            $image_path = $request->file('url_photo');
            $img_path_name = 'employee-'.$code.'.jpg';
            Storage::disk('public')->put($img_path_name, File::get($image_path));
        }
            
        $save = $newEmployee->save();
    
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

    private function createQr($code){
        $url = route('check.employee', ['code' => $code]);
        return QrCode::margin(5)->format('png')->size(500)->generate($url,'../public/qrcode/qrcode-'.$code.'.png');
    }

    public function downloadQr($code){
        $path = public_path().'/qrcode/qrcode-'.$code.'.png';
        $name = 'qrcode-'.$code.'.png';
        $headers = ['Content-Type: image/png'];
        return response()->download($path, $name, $headers);
    }

    public function downloadPhoto($code){
       
        $path = public_path().'/storage/employee-'.$code.'.jpg';
        $name = 'employee-'.$code.'.jpg';
        $headers = ['Content-Type: image/jpg'];
        return response()->download($path, $name, $headers);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $employee = Employee::find($id);

        $employee->delete();
            
        return response()->json([
            'succes' => true,
            'msg' => 'Eliminado correctamente'
        ]);
       
       
    }

    public function update(Request $request){
        $employee = Employee::find($request->id);
        $employee->fill($request->all());
        $employee->save();

        return response()->json([
            'succes' => true,
            'msg' => 'Actualizado correctamente'
        ]);
    }

    public function downDate(Request $request){
        $employee = Employee::find($request->id);
        $employee->down_date = $request->down_date;
        $employee->status = 0;
        $employee->save();

        return response()->json([
            'succes' => true,
            'msg' => 'Actualizado correctamente'
        ]);
    }

    /*public function permission(){
        //$user = Auth::user()->can('update.employee');
        $user = Auth::user()->hasRole('Admin');
        return response()->json([
            'User' => $user
        ]);
    }*/
}
