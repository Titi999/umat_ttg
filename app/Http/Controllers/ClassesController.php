<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
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

    function classes(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $lists = Classes::all();
        return view('admin.classes', compact('lists'), $data);
    }

    function addClass(Request $request){
        // validate requests
        $request -> validate([
         'name' => 'unique:classes',
        // 'capacity' => 'required',
        // 'amenities' => 'required',
        // 'status' => 'required'
        ]);
        $class = $request->input('class');
        $no_of_students = $request->input('capacity');
        $year = $request->input('year');
        $department = $request->input('department');
        $query = DB::table('classes')->insert([
            'name'=>$class.$year,
            'no_of_students'=>$no_of_students,
            'department'=>$department,

        ]);

        if($query){
            return back()->with('success', 'Class successfully added');
        }
        else{
            return back()->with('error', 'Oops!!! Something went wrong');
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
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $classes)
    {
        //
    }
    public function editPage($id){
        $user = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $data = Classes::find($id);
        return view('admin.editClasses', ['data'=>$data], $user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = Classes::find($id);

        if($data->delete()){
        return back()->with('success', 'Lecturer successfully deleted');
        }
        else{
            return back()->with('error', 'Oopa!!! Someting went wrong');
        }
    }

    public function updateClass(Request $req){
        $year = $req->year;
        $dep = $req->class;
        $classy = $dep.$year;
        $data = Classes::find($req->id);
        $data->name=$classy;
        $data->no_of_students=$req->capacity;
        $data->department=$req->department;
        
        
        $save = $data->save();
        if($save){
        return  redirect('/admin/classes') -> with('success', 'Class successfully updated');
        } else{
            return  back() -> with('error', 'Oops!!! Something went wrong');
        }
    }

}
