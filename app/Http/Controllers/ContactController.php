<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Contact; //Model
use Yajra\DataTables\DataTables; //Yajra dataTable
use Validator; //for vlidation
use Illuminate\Support\Str; //for str::random

use Illuminate\Support\Facades\File; 

class ContactController extends Controller
{
 
    public function index(Request $request)
    {
        
        if( $request->ajax() ){
            //$contact_data = Contact::all();
           $contact_data = Contact::latest()->get(); //get all data. Latest() use for last data
          

           //pass data to dataTable
            return DataTables::of($contact_data)
                ->addColumn('action', function($contact_data){
                        return '<a onclick="showData('.$contact_data->id.')" class="btn btn-success">
                                <i class="halflings-icon white wiew"></i>  
                            </a>'.' '.
                            '<a onclick="editForm('.$contact_data->id.')" class="btn btn-info">
                                <i class="halflings-icon white edit"></i>  
                            </a>'.' '.
                            '<a onclick="deleteData('.$contact_data->id.')" class="btn btn-danger">
                                <i class="halflings-icon white trash"></i> 
                            </a>'; //*/

                //})->make(true);
                })->addColumn('checkbox', function($contact_data){
                    return '<input type="checkbox" name="contact_checkbox[]" class="contact_checkbox" value="'.$contact_data->id.'" >'; 
                })->rawColumns(['action','checkbox']
                )->make(true);
        }

        return view('admin.contact');

        //<button type="button" name="edit" id="db_data" class="edit btn btn-primary btn-sm">Edit</button>
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'Ok';//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
       $validator = Validator::make($request->all(), [
            'contact_name' => 'required|min:3|max:40', 
            'contact_email' => 'required', 
            'contact_phone' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);

        }elseif($validator->passes()){ //bellow code will work without this condition
            $data=array();
            $data['contact_name']=$request->contact_name;
            $data['contact_email']=$request->contact_email;
            $data['contact_phone']=$request->contact_phone;
           //$data['contact_status']=$request->contact_status;
            $data['created_at']=date('d/m/y');

            if($request->contact_status == NULL){
                $data['contact_status'] = 0;
            }else{
               $data['contact_status']=$request->contact_status; 
            }

            $image = $request->file('contact_image');

            if($image){ //if image not empty
                $image_name = Str::random(40); //generate random number //use 
                $extention = strtolower($image->getClientOriginalExtension()); 
                $image_full_name=$image_name.'.'.$extention; 
                $upload_path='UploadImage/contact/'; //Define upload Path
                $image_url=$upload_path.$image_full_name; //make image URL for database
                $success = $image->move($upload_path,$image_full_name); 

                if($success){
                    $data['contact_image'] =$image_url;

                    Contact::create($data); 
                    return response()->json(['success'=>'Record is successfully added to DataTables']);
                }
            }else{ //if image empty
                $data['contact_image'] = NULL;

                Contact::create($data); 
                return response()->json(['success'=>'Record is successfully added to DataTables']);
            }

            //Contact::create($data); 
            //return Contact::create($data); // this will send undefine value//*/

           // return response()->json(['success'=>'Record is successfully added to DataTables']);
        }//*/

        //return response()->json(['success'=>'Record is successfully added to DataTables']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['success'=> 'Show Data Id -' . $id ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return response()->json(['success'=> 'Edit ID -' . $id ]);
        $contact = Contact::find($id);
        return $contact;
        //return response()->json(['data' => $contact]);
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
        $validator = Validator::make($request->all(), [
            'contact_name' => 'required|min:3|max:40', 
            'contact_email' => 'required', 
            'contact_phone' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);

        }//*/
        elseif($validator->passes()){ //bellow code will work without this condition            
            $data=array();
            $data['contact_name']=$request->contact_name;
            $data['contact_email']=$request->contact_email;
            $data['contact_phone']=$request->contact_phone;
            $data['contact_status']=$request->contact_status;
            $data['updated_at']=date('d/m/y');

            if($request->contact_status == NULL){
                $data['contact_status'] = 0;
            }else{
               $data['contact_status']=$request->contact_status; 
            }

            $image = $request->file('contact_image');

                if($image){ //if image not empty

                    //query for existing image
                    $existing_image = Contact::select('contact_image')->where('id', $request->id)->first();                   
                    if(!empty($existing_image->contact_image)) {                    
                       /// @unlink($existing_image->contact_image); //delete file from folder
                        File::delete($existing_image->contact_image); //delete file //use Illuminate\Support\Facades\File; at top
                    }//else{echo 'Empty';}  


                    $image_name = Str::random(40); //generate random number //use 
                    $extention = strtolower($image->getClientOriginalExtension()); 
                    $image_full_name=$image_name.'.'.$extention; 
                    $upload_path='UploadImage/contact/'; //Define upload Path
                    $image_url=$upload_path.$image_full_name; //make image URL for database
                    $success = $image->move($upload_path,$image_full_name); 

                    if($success){
                        $data['contact_image'] =$image_url;

                        Contact::whereId($request->id)->update($data); 
                        return response()->json(['success'=>'Record is successfully Update to DataTables']);
                    }
                }else{ //if image empty
                    //query for existing image
                    $existing_image = Contact::select('contact_image')->where('id', $request->id)->first();

                    $data['contact_image'] = $existing_image->contact_image;

                    Contact::whereId($request->id)->update($data); 
                    return response()->json(['success'=>'Record is successfully Update to DataTables']);
                }

           // return response()->json(['success'=>'Record is successfully Update to DataTables']);
        }//*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    public function destroy(Request $request, $id)   
    {   

        //query for existing image
        $existing_image = Contact::select('contact_image')->where('id', $id)->first();                   
        if( File::exists($existing_image->contact_image) ) {  
            File::delete($existing_image->contact_image); 
            //delete file //use Illuminate\Support\Facades\File; at top
        }

        //Contact::destroy($id);
        $data = Contact::findOrFail($id)->delete();
        //$data->delete();
        if($data){
            return response()->json(['success'=> 'Record is successfully deleted']);
        }else{
            return response()->json(['errors'=> 'Something is wrong..']);
        }//*/
    }

   //destry_multiple is extra method in this resource controller
    public function destroy_multiple(Request $request){
        //return $request->input('id');
       // $existing_image_array = Contact::select('contact_image')->whereIn('id', $request->input('id'))->get(); 
        $existing_image = Contact::select('contact_image')->whereIn('id', $request->input('id'))->get(); 
        $image_link_array = $existing_image->pluck('contact_image'); //pluck remove contact_image name from array

 
         foreach($image_link_array as $image){
           if(File::exists($image)) {
                File::delete($image);
           }
        }     
    
        $contact_id_array = $request->input('id');
        $contact = Contact::whereIn('id', $contact_id_array);
        if($contact->delete()){
           return response()->json(['success'=>'Multiple record delete is successfully']);
        }
        
    }



}
