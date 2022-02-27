<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view("pages/employee", ["posts"=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
             $validatedData = $request->validate([
                    'frist_name' => ['required'],
                    'last_name' => ['required'],
              ]);

              $Employee  = new Employee();
              $Employee ->frist_name = $request->input('frist_name');
              $Employee ->last_name = $request->input('last_name');
              $Employee ->company = $request->input('company');
              $Employee ->email = $request->input('email');
              $Employee ->phone = $request->input('phone');
              $Employee ->created_at=Carbon::now()->toDateTimeString();
              $saved=$Employee ->save();
              if(!$saved){
                  App::abort(500, 'Error');
              }
              

                
              return Response()->json([
                  "success" => true,
                  "file" => ''
              ]);
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'frist_name' => ['required'],
            'last_name' => ['required'],
         ]);

        $Employee=Employee::find($id);
        $Employee ->frist_name = $request->input('frist_name');
        $Employee ->last_name = $request->input('last_name');
        $Employee ->company = $request->input('company');
        $Employee ->email = $request->input('email');
        $Employee ->phone = $request->input('phone');
        $Employee ->updated_at=Carbon::now()->toDateTimeString();
        $updated=$Employee->update();
        if(!$updated){
            App::abort(500, 'Error');
        }
     
        return Response()->json([
            "success" => true,
            "file" => ''
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Employee=Employee::find($id);
        $Employee->delete();
        return response()->json([
            'status'=>200,
            'company_details' => 'deleted' ,
        ]);
    } 


    public function allEmployeeDetails(Request $request,$id)
    {

       $EmployeeDetails  = Employee::where('company', '=', $id)->orderBy('id', 'desc')->paginate(10);
      
        return response()->json([
            'status'=>200,
            'employee_details' => $EmployeeDetails ,
        ]);
        
    }
}
