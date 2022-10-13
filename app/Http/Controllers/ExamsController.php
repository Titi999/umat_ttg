<?php

namespace App\Http\Controllers;
use App\Models\Exams;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    function index(){
        return view('admin.exams');
    }
}
