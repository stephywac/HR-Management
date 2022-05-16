<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   
    public function index()
    {
        $UsersLists =  User:: select ('*')
                ->where('id', '!=' , 1)
                ->get();
         $count=count($UsersLists); 
         //dd( $count);      
       return view('admin.dashboard',compact('UsersLists','count'));
    }

    public function login()
    {
        return view('auth.login');
    }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
       
        Auth::logout();
        return redirect('/login');
      }

      public function postLogin(Request $request)
      {
          
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
           
            return redirect()->route('home'); 
        }else{
           
            if(!User::where('email', '=', $request->email)->exists() )
            {
                return redirect()->route('login')
                ->with('error',' Incorrect Email-Address.');
            }
           
            else if(User::where('email', '=', $request->email)->exists() && !User::where('password', '=', Hash::make($request->password))->exists() )
            { 
                return redirect()->route('login')
                ->with('error','Password  incorrect.');
            }
            else 
            {
                return redirect()->route('login')
                ->with('error','Email-Address and password  Are Wrong.');
            }


           
        }
      }
        
}
