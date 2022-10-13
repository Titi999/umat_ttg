<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;
use App\Models\Lecturer;
use App\Models\Halls;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    function courses(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $lists = Lecturer::all();
        $courses = Course::all();
        $classes = Classes::all();
        $classes = Classes::all();
        $halls = Halls::all();
    
        return view('admin.courses', $data, compact('lists','courses', 'classes', 'halls'));
    }

    function addCourse(Request $request){
        //dd($request->input('preferred_hall'));
        if(($request->input('combined')) == "Yes"){
            $class = $request->input('class')." & ".$request->input('cclass');
            $combined = "Yes";
        }
        else{
            $class = $request->input('class');
            $combined = "No";
        }
        $query = DB::table('courses')->insert([
            'name'=>$request->input('name'),
            'code'=>$request->input('code'),
            'combined'=>$combined,
            'class'=> $class,
            'periods'=>$request->input('creditHours'),
            'combined_periods'=>$request->input('combinedPeriods'),
            'lecturer'=>$request->input('lecturer'),
            'semester'=>$request->input('semester'),
            'preferred_hall'=>$request->input('preferred_hall')
        ]);

        if($query){
            return back()->with('success', 'Course successfully added');
        }
        else{
            return back()->with('error', 'Oops!!! Something went wrong');
        }
    }

    public function destroy($id) {
        $data = Course::find($id);

        if($data->delete()){
        return back()->with('success', 'Lecturer successfully deleted');
        }
        else{
            return back()->with('error', 'Oopa!!! Someting went wrong');
        }
    }

    public function editPage($id){
        $user = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $data = Course::find($id);
        $classes = Classes::all();
        $lists = Lecturer::all();
        return view('admin.editCourse', $user, compact('lists', 'data', 'classes'));

    }

    public function updateCourse(Request $req){
        $data = Course::find($req->id);
        $data->name=$req->name;
        $data->code=$req->code;
        $data->class=$req->department.$req->year;
        $data->credit_hours=$req->creditHours;
        $data->lecturer=$req->lecturer;
        $data->semester=$req->semester;
        
        $save = $data->save();
        if($save){
        return  redirect('/admin/courses') -> with('success', 'Course successfully updated');
        } else{
            return  back() -> with('error', 'Oops!!! Something went wrong');
        }
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
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
   
}
