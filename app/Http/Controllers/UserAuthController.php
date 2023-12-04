<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAuth;
use Illuminate\Support\Facades\Hash;


class UserAuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }
    // dashboard
    public function dashboard(){
        // check if user is logged in
        if(session()->has('LoggedUser')){
            // fetch user data
            $user = UserAuth::where('id', '=', session('LoggedUser'))->first();
            // array of user data
            $data = [
                'LoggedUserInfo' => $user
            ];
            // if user is logged in
            return view('auth.dashboard', $data);
        }
    }
    public function registerUser(Request $request){
        // validate requests
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user_auths',
            'password' => 'required|min:6|max:12'
        ]);
        // insert data into database
        $user = new UserAuth;
        $user->name = $request->name;
        $user->email = $request->email;
        // hash password
        $user->password = Hash::make($request->password);
        $query = $user->save();
        if($query){
            return back()->with('success', 'You have been successfuly registered');
        }else{
            return back()->with('fail', 'Something went wrong');
        }
    }
    public function loginUser(Request $request){
        // validate requests
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:12'
        ]);
        $user = UserAuth::where('email', '=', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('LoggedUser', $user->id);
                return redirect('dashboard');
            }else{
                return back()->with('fail', 'Invalid password');
            }
        }else{
            return back()->with('fail', 'No account found for this email');
        }
    }
    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }
}
