<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Candidate;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Hash;

class CandidateRegisterController extends Controller
{
  public function candidate_register(Request $request)
  {
    $designation=Designation::all();
    // dd($designation);
   return view('admin.register',compact('designation'));
  }

  function store(Request $request)
  {
   
    try {
      $validator = Validator::make($request->all(), [
        'first_name' => 'required|min:1|max:255',
        'last_name' => 'required|min:1|max:255',
        'email' => 'required|email|unique:users,email',
        'mobileno' => 'required',
        'designation' => 'required',
        'resume' => 'required',
      ]);
      if ($validator->fails()) {
               
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
       
    }
    else{
      $file = $request->resume;
      $name = Str::random(8);
      $fileName =  $name . '.pdf'; // you can also use file name
      $file->storeAs('', $fileName, '');
      $user = new User();
      $user->name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->designation_id = $request->designation;
      $user->resume = $fileName;
      $user->email = $request->email;
      $user->age = $request->age;
      $user->mobile = $request->mobileno;
      $user->address = $request->address;
      $user->experience = $request->experience;
      $user->password=Hash::make('1234567890');
      $user->save();
     
      $response = array(
        'error' => 0,
        'status' => true
    );
    return json_encode($response);
    }

      
    } catch (\Exception $e) {
      flash(__('Technical error! Please try again'))->error();
      Log::error($e);
      return redirect()->back()->withInput();
    }
  }
}
