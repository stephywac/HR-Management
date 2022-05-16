<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use DB;
use App\User;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\json_encode;
use App\Designation;
use Illuminate\Support\Str;
class SettingsController extends Controller
{
    public function department(Request $request)
    {
        $departments = Department::paginate(5); 
        return view('admin.department.list',compact('departments'));
    }



    public function department_edit($id,Request $request)
    {
        $department = Department::find($id);
        return view('admin.department.edit', compact('department'));
    }


    public function add_department(Request $request)
    {
        
        try {
            $validator  = Validator::make(
                $request->all(),
                [
                    'department_name' => 'required|string|max:255|unique:departments,department_name',
                ]
            );

            if ($validator->fails()) {

                flash($validator->errors()->first())->error();
                $response = ['status' => 'failure', 'msg' =>$validator->errors()];
                return response()->Json($response);
            }
            
          

                $insert_data = array(
                    'department_name' => $request->department_name,
                    'status' => $request->d_status,
                    'created_at' => now(), 
                    'updated_at' => now(),
                   
                );
                DB::table('departments')->insert($insert_data);
                $response = ['status' => 'success', 'msg' => __(':name Created.', ['name' => __('Department')])];
                return response()->Json($response);
            
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'errors' => $e
            ], 500);
        }
    }

    public function edit_department(Request $request)
    {
        $department = Department::find($request->id);
        return response()->Json($department);

    }

    public function update_department(Request $request)
    {
        // dd("Df");
        try {
            $validator  = Validator::make(
                $request->all(),
                [
                    'department_name1' => 'required|string|max:255|unique:departments,department_name,'.$request->id,
                ]
            );

            if ($validator->fails()) {

                flash($validator->errors()->first())->error();
                $response = ['status' => 'failure', 'msg' =>$validator->errors()];
                return response()->Json($response);
            }
                $update_data = array(
                    'department_name' => $request->department_name1,
                    'status' => $request->d_status1,
                    'updated_at' => now(),
                   
                );
                DB::table('departments')->where('id',$request->id)->update($update_data);
                $response = ['status' => 'success', 'msg' => __(':name Updated.', ['name' => __('Department')])];
                return response()->Json($response);
            
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'errors' => $e
            ], 500);
        } 
    }


    public function delete_department(Request $request)
    {
        // dd("Df");
        try {
                 $res=Department::where('id',$request->id)->delete();
                 $designation=Designation::where('department_id',$request->id)->delete();
                 $user=User::where('department_id',$request->id)->delete();
                $response = ['status' => 'success', 'msg' => __(':name Deleted.', ['name' => __('Department')])];
                return response()->Json($response);
            
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'errors' => $e
            ], 500);
        } 
    }


    public function designation(Request $request)
    {
        $designations = Designation::with('department')->paginate(5); 
        // dd($designations);
        $departments=Department::all();
        return view('admin.designation.list',compact('designations','departments'));
    }


    public function add_designation(Request $request)
    {
        
        try {
            $validator  = Validator::make(
                $request->all(),
                [
                    'department_id' => 'required',
                    'designation' => 'required|string|max:255|unique:designations,name',
                    
                ]
            );

            if ($validator->fails()) {

                flash($validator->errors()->first())->error();
                $response = ['status' => 'failure', 'msg' =>$validator->errors()];
                return response()->Json($response);
            }
            
          

                $insert_data = array(
                    'name' => $request->designation,
                    'status' => $request->d_status,
                    'department_id' => $request->department_id,
                    'slug'=>Str::slug($request->designation),
                    'created_at' => now(), 
                    'updated_at' => now(),
                   
                );
                DB::table('designations')->insert($insert_data);
                $response = ['status' => 'success', 'msg' => __(':name Created.', ['name' => __('Department')])];
                return response()->Json($response);
            
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'errors' => $e
            ], 500);
        }
    }

    public function edit_designation(Request $request)
    {
        $designation = Designation::with('department')->find($request->id);
        return response()->Json($designation);

    }

    public function update_designation(Request $request)
    {
        // dd("Df");
        try {
            $validator  = Validator::make(
                $request->all(),
                [
                    'designation_name1' => 'required|string|max:255|unique:designations,name,'.$request->id,
                ]
            );

            if ($validator->fails()) {

                flash($validator->errors()->first())->error();
                $response = ['status' => 'failure', 'msg' =>$validator->errors()];
                return response()->Json($response);
            }
                $update_data = array(
                    'name' => $request->designation_name1,
                    'department_id' => $request->department_id1,
                    'status' => $request->d_status1,
                    'updated_at' => now(),
                   
                );
                DB::table('designations')->where('id',$request->id)->update($update_data);
                $response = ['status' => 'success', 'msg' => __(':name Updated.', ['name' => __('Department')])];
                return response()->Json($response);
            
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'errors' => $e
            ], 500);
        } 
    }


    public function delete_designation(Request $request)
    {
        // dd("Df");
        try {
               $res=Designation::where('id',$request->id)->delete();
               $users=User::where('designation_id',$request->id)->delete();

                $response = ['status' => 'success', 'msg' => __(':name Deleted.', ['name' => __('Designation')])];
                return response()->Json($response);
            
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'errors' => $e
            ], 500);
        } 
    }
    public function getDesignation(Request $request)
    {
       
        try {
            $html="";
            $designation_lists = Designation::where([
                'department_id' => $request->value,
                'status' => 1,
            ])->get();
            if($designation_lists)
            {
                $html.='<option value="" >Select</option>';
                foreach($designation_lists as $designation_list)
                {
                    $html.='<option value="'.$designation_list->id.'">'.$designation_list->name.'</option>';
                }
            }
             else{
                $html.='<option value="">no data found</option>';
             }
             return $html;
         
     } catch (\Exception $e) {

         return response()->json([
             'success' => false,
             'errors' => $e
         ], 500);
     } 
    }


    public function edit_get(Request $request)
    {
       
        try {
            $user_deatils =User::where('id',$request->user)->first();
            
            $html="";
            $designation_lists = Designation::where([
                'department_id' => $request->value,
                'status' => 1,
            ])->get();
            if($designation_lists)
            {
               
                $html.='<option value="" >Select</option>';
                foreach($designation_lists as $designation_list)
                {
                    $selected = '';
                    if ($designation_list->id == $user_deatils->designation_id)    // Any Id
                    {
                        $selected = 'selected="selected"';
                    }
                    $html.='<option value="'.$designation_list->id.'"  '.$selected.'>'.$designation_list->name.'</option>';
                }
            }
             else{
                $html.='<option value="">no data found</option>';
             }
             return $html;
         
     } catch (\Exception $e) {

         return response()->json([
             'success' => false,
             'errors' => $e
         ], 500);
     } 
    }

}
