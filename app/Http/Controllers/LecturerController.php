<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function lecturers(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $lists = Lecturer::all();
        return view('admin.lecturers', compact('lists'), $data);
    }

    function addLecturer(Request $request){
        // //validate requests
        //  $request -> validate([
        // 'name' => 'required|unique:halls',
        // 'capacity' => 'required',
        // 'amenities' => 'required',
        // 'status' => 'required'
        // ]);
        $title = $request->input('title');
        $name = $request->input('name');
        $query = DB::table('lecturers')->insert([
            'name'=>$title." ".$name,
            'department'=>$request->input('department'),
            'status'=>$request->input('status'),
        ]);

        if($query){
            return back()->with('success', 'Lecturer successfully added');
        }
        else{
            return back()->with('error', 'Oops!!! Something went wrong');
        }
    }

    public function destroy($id) {
        $data = Lecturer::find($id);

        if($data->delete()){
        return back()->with('success', 'Lecturer successfully deleted');
        }
        else{
            return back()->with('error', 'Oopa!!! Someting went wrong');
        }
    }

    public function editPage($id){
        $user = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $data = Lecturer::find($id);
        return view('admin.editLecturer', ['data'=>$data], $user);

    }

    public function updateLecturer(Request $req){
        $data = Lecturer::find($req->id);
        $data->title=$req->title;
        $data->name=$req->name;
        $data->department=$req->department;
        $data->status=$req->status;
        
        
        $save = $data->save();
        if($save){
        return  redirect('/admin/lecturers') -> with('success', 'Lecture successfully updated');
        } else{
            return  back() -> with('error', 'Oops!!! Something went wrong');
        }
    }


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
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturer $lecturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecturer $lecturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    
}
