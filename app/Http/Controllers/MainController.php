<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Halls;
use App\Models\Lecturer;

use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    function login(){
        return view('auth.login');
    }

    function save(Request $request){
        
        //return $request->input(); 
        //validate requests
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|max:12'
        ]);

        //Insert Data into database
        $admin = new Admin;
        $admin-> name = $request -> name;
        $admin-> email = $request -> email;
        $admin-> password = Hash::make($request -> password);
        $save = $admin->save();

        if($save){
            return  back() -> with('success', 'New user has been successfully created');
        }
        else{
            return  back() -> with('fail', 'Something went wrong, try again');
        }
    
    }


    function check(Request $request){
       //Validate requests
       $request->validate([
        'email'=>'required|email',
     'password'=>'required'
        ]);
       $userEmail = Admin::where('email', '=', $request->email)->first();
       

       if($userEmail){
           if(Hash::check($request->password, $userEmail->password)){
            $request->session()->put('LoggedUser', $userEmail->id);
            return redirect('admin/dashboard');
           }
           else{
            return  back() -> with('fail', 'Incorrect email or password');
           }
       }
       else{
        return  back() -> with('fail', 'Incorrect email or password');
       }
    }
    
    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }

    function dashboard(){
        $lectureHalls = Halls::count();
        $courses = Course::count();
        $lecturers = Lecturer::count();
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        // Log::info($lectureHalls);
        $recent = Admin::where('id', '=', session('LoggedUser'))->first()->recent;
        $lecture_halls = Halls::all();
        $colors = ['red', 'yellow', 'green', 'blue', 'redlike', 'yellowlike', 'bluelike', 'greenlike'];
        $assignmentMonday = DB::table('first_semester')->where('day', 'Monday')->get();
        $assignmentTuesday = DB::table('first_semester')->where('day', 'Tuesday')->get();
        $assignmentWednesday = DB::table('first_semester')->where('day', 'Wednesday')->get();
        $assignmentThursday = DB::table('first_semester')->where('day', 'Thursday')->get();
        $assignmentFriday = DB::table('first_semester')->where('day', 'Friday')->get();
        $assignmentMonday2 = DB::table('second_semester')->where('day', 'Monday')->get();
        $assignmentTuesday2 = DB::table('second_semester')->where('day', 'Tuesday')->get();
        $assignmentWednesday2 = DB::table('second_semester')->where('day', 'Wednesday')->get();
        $assignmentThursday2 = DB::table('second_semester')->where('day', 'Thursday')->get();
        $assignmentFriday2 = DB::table('second_semester')->where('day', 'Friday')->get();
        $hallsNo = Halls::count();

        return view('admin.dashboard', $data, compact('lectureHalls', 'courses', 'lecturers', 'recent', 'lecture_halls', 'colors', 'assignmentMonday', 'assignmentTuesday', 'assignmentWednesday', 'assignmentThursday', 'assignmentFriday', 'hallsNo', 'assignmentMonday2', 'assignmentTuesday2', 'assignmentWednesday2', 'assignmentThursday2', 'assignmentFriday2'));
    }

    function halls(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.halls', $data);
    }
    // function index(){
    //     $datas = array(
    //         'list' => DB::table('halls')->get()
    //     );
    //     return view('admin.halls', $datas);
    // }

    function courses(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.courses', $data);
    }

    function lecturers(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.lecturers', $data);
    }

    function settings(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.settings', $data);
    }


    public function destroy($id) {
        $data = Halls::find($id);
        $data->delete();
        return redirect('admin.halls');
        // $query = DB::delete('delete from halls where id = ?',[$id]);
        // if($query){
        //     return back()->with('success', 'Lecture Hall successfully added');
        // }
        // else{
        //     return back()->with('error', 'Something went wrong');
        // }
    }

    // function addHalls(Request $request){
        
    //     $first_name = $request->input('first_name');
    //     $last_name = $request->input('last_name');
    //     $city_name = $request->input('city_name');
    //     $email = $request->input('email');
    //     $data=array('first_name'=>$first_name,"last_name"=>$last_name,"city_name"=>$city_name,"email"=>$email);
    //     DB::table('student_details')->insert($data);
    //     echo "Record inserted successfully.<br/>";
    //     echo '<a href = "/insert">Click Here</a> to go back.';
    // }

    // public function index()
    // {
    //     $halls = insertHalls::select('select * from halls');
    //     return view('halls.index', ['halls'=>$halls]);
    //     // $halls = insertHalls::all();
    //     // return view('/admin/halls', compact('halls'));
       
    // }


}
