<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       
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
                     'company_name' => ['required'],
            ]);
        
    
           if ($files = $request->file('file')) {
             request()->validate([
                'file'  => 'required|mimes:jpg,png|max:2048',
              ]);

               $Company  = new Company();

               if (Company::where('email', $request->email)->exists()) {
                  return "This email name is saved already";
               }else{
                //store file into document folder
               $files = $request->file->store('public');    
               $file = explode("public",$files);
              
               $Company->company_name = $request->input('company_name');
               $Company->email = $request->input('email');
               $Company->website_name = $request->input('website_name');
               $Company->logo_path =$file[1];
               $Company->created_at=Carbon::now()->toDateTimeString();
               $saved=$Company->save();
               if(!$saved){
                   App::abort(500, 'Error');
               }
               }

                 
               return Response()->json([
                   "success" => true,
                   "file" => $file
               ]);
     
           }else{
           
            $Company  = new Company();
            $Company->company_name = $request->input('company_name');
            $Company->email = $request->input('email');
            $Company->website_name = $request->input('website_name');
            $Company->logo_path ='default.jpg';
            $Company->created_at=Carbon::now()->toDateTimeString();
            $saved=$Company->save();
            if(!$saved){
                App::abort(500, 'Error');
            }
            return Response()->json([
                "success" => true,
            ]);
            }
           
     
           return Response()->json([
                   "success" => false,
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
                  'company_name' => ['required'],
         ]);
    
        if ($files = $request->file('file')) {
            
        $Company  = new Company();

        
       
        $files = $request->file->store('public');    
        $file = explode("public",$files);
        

        $Company=Company::find($id);
        
        $Company->company_name = $request->input('company_name');
        $Company->email =$request->email;
        $Company->website_name = $request->website_name;
        $Company->logo_path =$file[1];
        $Company->updated_at=Carbon::now()->toDateTimeString();
        $updated=$Company->update();
        if(!$updated){
            App::abort(500, 'Error');
        }
        // }

          
        return Response()->json([
            "success" => true,
            "file" => $file
        ]);

    }else{ 
        
        $Company=Company::find($id);
        $Company->company_name = $request->input('company_name');
        $Company->email =$request->email;
        $Company->website_name = $request->website_name;
        $Company->updated_at=Carbon::now()->toDateTimeString();
        $updated=$Company->update();
        if(!$updated){
            App::abort(500, 'Error');
        }
       return Response()->json([
            "success" => false,
            "file" => 'Updated'
      ]);
    }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Company=Company::find($id);
        $logoPath= $Company->logo_path;
        unlink("storage".$logoPath);
        $Company->delete();
        return response()->json([
            'status'=>200,
            'company_details' => 'deleted' ,
        ]);
    }


    public function allCompanyDetails(Request $request)
    {

       $CompanyDetails  = Company::orderBy('id', 'desc')->paginate(10);
      
        return response()->json([
            'status'=>200,
            'company_details' => $CompanyDetails ,
        ]);
        
    }
}
