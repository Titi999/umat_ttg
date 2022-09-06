<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{

    function settings(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.settings', $data);
    }

    function updateUser(Request $req){
        $req -> validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);
        $data = Admin::find($req->id);
        $data->name=$req->username;
        $data->email=$req->email;
        
        $save = $data->save();
        if($save){
        return  redirect('/admin/settings') -> with('success', 'User Profile Update Successfully');
        } else{
            return  back() -> with('error', 'Oops!!! Something went wrong');
        }
    }
    

    function updatePassword(Request $req){
        $validateData = $req->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:8|max:12',
        ]);

        $hashedPassword = Admin::find($req->id)->password;

        if(Hash::check($req->oldPassword, $hashedPassword)){
            $user = Admin::find($req->id);
            $user -> password = Hash::make($req -> password);
            $save = $user -> save();

            if($save){
                Auth::logout();
                Session::flush();
                return  redirect('/auth/login') -> with('success', 'Password Changed Successfully');
            } 
            else{
                    return back() -> with('error', 'Oops!!! Something went wrong');
            }
            
        }

        
    }

    public function updateProfileImg(Request $request)
    {
        if($request->hasFile('profileImage')){
            // $filename = $request->profileImage->getClientOriginalName();
            // $request->profileImage->storeAs('images',$filename,'public');
            // $user = Admin::find($request->id);
            // $user->profile_img = $filename;
            // return back() -> with('success', 'Profile Image Changed Successfully');
            $filename = $request->profileImage->getClientOriginalName();
            $request->profileImage->storeAs('images',$filename, 'public');
            //Auth()->user()->update(['image'=>$filename]);
            $user = Admin::find($request->id);
            $user->profile_img = $filename;
            $save = $user -> save();
            if($save){
                return back() -> with('success', 'Profile Image Changed Successfully');
            }
            return back() -> with('error', 'Oops!!! Something went wrong');
            
        }
        return back() -> with('error', 'Oops!!! Something went wrong');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
