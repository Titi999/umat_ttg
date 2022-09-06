<?php

namespace App\Http\Controllers;

use App\Models\Halls;
use Illuminate\Http\Request;
use App\Models\Admin;

use Illuminate\Support\Facades\DB;

class HallsCrud extends Controller
{
    //
   

    public function index(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $lists = Halls::all();
        return view('admin.halls', compact('lists'), $data);
    }

    public function destroy($id) {
        $data = Halls::find($id);

        if($data->delete()){
        return back()->with('success', 'Lecture Hall successfully deleted');
        }
        else{
            return back()->with('error', 'Oopa!!! Someting went wrong');
        }
        // $query = DB::delete('delete from halls where id = ?',[$id]);
        // if($query){
        //     return back()->with('success', 'Lecture Hall successfully added');
        // }
        // else{
        //     return back()->with('error', 'Something went wrong');
        // }
    }

    function add(Request $request){
        //validate requests
         $request -> validate([
        'name' => 'required|unique:halls',
        'capacity' => 'required',
        'amenities' => 'required',
        'status' => 'required'
        ]);

        $query = DB::table('halls')->insert([
            'name'=>$request->input('name'),
            'department'=>$request->input('department'),
            'capacity'=>$request->input('capacity'),
            'average_classes'=>$request->input('capacity')/50,
            'amenities'=>$request->input('amenities'),
            'status'=>$request->input('status'),
        ]);

        if($query){
            return back()->with('success', 'Lecture Hall successfully added');
        }
        else{
            return back()->with('error', 'Something went wrong');
        }
    }

    public function editPage($id){
        $user = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $data = Halls::find($id);
        return view('admin.editHalls', ['data'=>$data], $user);

    }

    public function updateHalls(Request $req){
        $data = Halls::find($req->id);
        $data->name=$req->name;
        $data->department=$req->department;
        $data->capacity=$req->capacity;
        $data->average_classes=$req->capacity/50;
        $data->amenities=$req->amenities;
        $data->status=$req->status;
        $save = $data->save();
        if($save){
        return  redirect('/admin/halls') -> with('success', 'Lecture Hall successfully updated');
        } else{
            return  back() -> with('error', 'Oops!!! Something went wrong');
        }
    }
}
