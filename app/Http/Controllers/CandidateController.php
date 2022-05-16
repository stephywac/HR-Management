<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Designation;
use App\Department;;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CandidateController extends Controller
{

    public function index(Request $request)
    {
        // dd($request->id);
        return view('editor');
    }

    public function codeRun()
    {

        //if (isset($_POST['code']) === true) {
        //$code = (string) $_POST['code'];


        //     $code = trim($code);


        //     ob_start();
        //     eval($code);
        //     $buffer = ob_get_clean();


        //     $error = error_get_last();
        //     if($error > 0) {

        //         $error['error'] = getErrorName($error['type']);
        //         $jsonError = json_encode($error, true);

        //         echo strtoupper($error['error']);
        //         header('Z-Error: '. $jsonError);
        //     } else {
        //         echo $buffer;
        //     }
        // }

        $language = strtolower($_POST['language']);
        $code = $_POST['code'];

        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = storage_path('temp') . $random . "." . $language;
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $code);
        fclose($programFile);

        if ($language == "php") {
            $output = shell_exec("php.exe $filePath");
            echo $output;
            // echo "Your Answer: $output";
        }
        if ($language == "python") {
            $output = shell_exec("python.exe $filePath ");
            echo $output;
        }
        if ($language == "node") {
            rename($filePath, $filePath . ".js");
            $output = shell_exec("node $filePath.js ");
            echo $output;
        }
        if ($language == "c") {
            //    $tempOutputFile = storage_path('test.exe');
            //     shell_exec("gcc $filePath");
            //     $output = shell_exec($tempOutputFile);
            //     echo $output;
            $tempOutputFile = Storage::disk('public')->put($random . ".exe", $filePath);
            shell_exec("gcc $filePath -o $tempOutputFile");
            $output = shell_exec($tempOutputFile);
            echo  $output;
        }
        if ($language == "cpp") {
            // $outputExe = $random . ".exe";
            // shell_exec("g++ $filePath -o $outputExe");
            // $output = shell_exec(__DIR__ . "//$outputExe");
            // echo $output;
            $tempOutputFile = Storage::disk('public')->put($random . ".exe", $filePath);
            shell_exec("g++ $filePath -o $tempOutputFile");
            $output = shell_exec($tempOutputFile);
            echo $output;
        }
    }

    public function list(Request $request)
    {
        $UsersLists = User::with('user_types','user_designation','user_department')->where('user_type', 2)->paginate(10);
        //    dd($UsersLists);
        return view('admin.candidate_list', compact('UsersLists'));
    }

    public function candidate_edit($id, Request $request)
    {
        $userDetail = User::findOrFail($id);
       // dd( $userDetail );
        $designation = Designation::where('status',1)->get();
        $departments  = Department::where('status',1)->get();
        $path =  Storage::disk('resume')->url($userDetail->resume);
        //   dd($path);
        return view('admin.candidate_edit', compact('userDetail', 'designation', 'path','departments'));
    }

    public function candidate_update(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:1|max:255',
            'last_name' => 'required|min:1|max:255',
            'email' => 'required|email|unique:users,email,' . $request->user_id,
            'mobileno' => 'required|digits:10',
            'designation' => 'required',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:10000',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        } else {
            if ($request->resume) {
                $file = $request->resume;
                $name = Str::random(8);
                $fileName =  $name . '.pdf'; // you can also use file name
                Storage::disk('resume')->putFileAs('',  $file, $fileName);
                $update_data = array(
                    'name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'designation_id' => $request->designation,
                    'department_id' => $request->department,
                    'resume' => $fileName,
                    'email' => $request->email,
                    'age' => $request->age,
                    'mobile' => $request->mobileno,
                    'address' => $request->address,
                    'experience' => $request->experience,
                    'password' => Hash::make('1234567890'),
                    'user_type' => 2,
                );
                DB::table('users')->where('id', $request->user_id)->update($update_data);
                $response = array(
                    'error' => 0,
                    'status' => true
                );
                return json_encode($response);
            } else {

                $update_data = array(
                    'name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'designation_id' => $request->designation,
                    'department_id' => $request->department,
                    'email' => $request->email,
                    'age' => $request->age,
                    'mobile' => $request->mobileno,
                    'address' => $request->address,
                    'experience' => $request->experience,
                    'password' => Hash::make('1234567890'),
                    'user_type' => 2,
                );
                DB::table('users')->where('id', $request->user_id)->update($update_data);
                $response = array(
                    'error' => 0,
                    'status' => true
                );
                return json_encode($response);
            }
        }
    }


    public function candidate_search(Request $request)
    {
        $text = $request->input('search_keyword');
        $html = "";
        $UsersLists =  User::with('user_types')->where('name', 'LIKE', '%' . $text . "%")->get();
        foreach ($UsersLists as $UsersList) {
            $html .= '<tr class="odd">
        <td>
        </td><td class="d-flex align-items-center">
        
            <div class="d-flex flex-column">
                <a href="" class="text-gray-800 text-hover-primary mb-1">' . $UsersList->name . '</a>
                <span>' . $UsersList->email . '</span>
            </div>
        </td>
        <td>' . $UsersList->user_types->type . '</td>

        <td data-order="">' . $UsersList->created_at . '</td>

        <td class="text-end">
            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
               
                <span class="svg-icon svg-icon-5 m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                    </svg>
                </span>
               
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                
                <div class="menu-item px-3">
                    <a href="'.url('candidate_edit/' . $UsersList->id).'" class="menu-link px-3">Edit</a>
                </div>
              
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                </div>
              
            </div>
           
        </td>        


    </tr>';
        }
        return $html;
    }




    public function candidate_delete(Request $request)
    {
        // dd("Df");
        try {
               $res=User::where('id',$request->id)->delete();
                $response = ['status' => 'success', 'msg' => __(':name Deleted.', ['name' => __('Designation')])];
                return response()->Json($response);
            
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'errors' => $e
            ], 500);
        } 
    }
}
