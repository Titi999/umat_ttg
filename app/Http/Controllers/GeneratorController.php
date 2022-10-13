<?php

namespace App\Http\Controllers;

use App\Models\Generator;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Halls;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Lecturer;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Illuminate\Support\Str;


class GeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generator()
    {   
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $lecture_halls = Halls::all();
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
        $colors = ['red', 'yellow', 'green', 'blue', 'redlike', 'yellowlike', 'bluelike', 'greenlike'];
        return view('admin.generator', $data, compact('lecture_halls', 'colors', 'hallsNo', 'assignmentMonday', 'assignmentTuesday', 'assignmentWednesday', 'assignmentThursday', 'assignmentFriday', 'assignmentMonday2', 'assignmentTuesday2', 'assignmentWednesday2', 'assignmentThursday2', 'assignmentFriday2'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function firstSemester(){
        $coursesNo = Course::where('semester', 'First')->count();
        $courses =  DB::table('courses')->where('semester', 'First')->get();
        $timearray = ["6:00", "8:00", "10:00", "12:30", "14:30", "16:30"];
        $dayarray = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        for($i = 0; $i < $coursesNo; $i++)   
        {  set_time_limit(0);
            $periods = $courses[$i]->periods;
            $randomCourse = $courses[$i]->name;
            $preferedHall = $courses[$i]->preferred_hall;
            $lecturer = $courses[$i] -> lecturer;
            $class = $courses[$i]->class;
            $loop = 0;
            if(($courses[$i]->combined) == "No"){
            $capacity =  DB::table('classes')->where('name', $class)->first()->no_of_students;
            do{
                $loop++;
                $clash = true;
                $time = $timearray[array_rand($timearray)];
                $day = $dayarray[array_rand($dayarray)];
                $hall = Halls::inRandomOrder()->first();
                if($preferedHall == "No"){
                $randomHall = $hall['name'];
                }
                else{
                    $randomHall = $preferedHall;
                }
                $HallCapacity = $hall['capacity'];
                $newtime = Carbon::parse($time)->addHour()->format('H:i');

                $nptime = $timearray[array_rand($timearray)];
                $npday = $dayarray[array_rand($dayarray)];
                $nprandomHall = Halls::inRandomOrder()->first()['name'];
                $npnewtime = Carbon::parse($nptime)->addHour()->format('H:i');
                $whereCondition = [
                    ['day', $day],
                    ['time', $time],
                    ['lecturer', $lecturer ]
                ];
                $whereCondition1 = [
                    ['day', $day],
                    ['time', $time],
                    ['lecture_hall', $randomHall ]
                ];
                $whereCondition2 = [
                    ['day', $npday],
                    ['time', $nptime],
                    ['lecturer', $lecturer ]
                ];

                $whereCondition3 = [
                    ['day', $day],
                    ['course', $randomCourse ]
                ];
                $whereCondition4 = [
                    ['day', $day],
                    ['time', $newtime],
                    ['lecture_hall', $randomHall]
                ];
                $whereCondition5 = [
                    ['day', $npday],
                    ['time', $nptime],
                    ['lecture_hall', $nprandomHall]
                ];
                $whereCondition6 = [
                    ['day', $npday],
                    ['time', $npnewtime],
                    ['lecture_hall', $nprandomHall]
                ];
            
            if (DB::table('first_semester')->where($whereCondition)->orWhere($whereCondition1)->orWhere($whereCondition3)->exists()) {
                $clash = false;
            }
            // if(DB::table('first_semester')->where('day', $day)->where('time', $time)->where('lecture_hall',$randomHall['name'])->exists()){   
            //     $clash = false;  
            // }
            // if (DB::table('first_semester')->where('day', $npday)->where('time', $nptime)->where('lecturer',$randomCourse->lecturer)->exists()) {
            //     $clash = false;
            // }
            // if(DB::table('first_semester')->where('day', $npday)->where('time', $nptime)->where('lecture_hall',$nprandomHall['name'])->exists()){   
            //     $clash = false; 
            // }

            // if(DB::table('first_semester')->where('day', $day)->where('course',$randomCourse->name)->exists()){
            //     $clash = false;
            // }
            if($periods >= 2 && DB::table('first_semester')->where($whereCondition4)->exists()){
                $clash = false;
            }
            if($periods >= 3 && DB::table('first_semester')->where($whereCondition5)->orWhere($whereCondition2)->exists() || $day == $npday) {
                $clash = false;
            }
            if($periods == 4 && DB::table('first_semester')->where($whereCondition6)->exists()){
                $clash = false;
            }
            // if($loop > 50000 ){
            //     return back()->with('error', 'Something Went Wrong');
            // }
            }
            while($clash == false);
            if($periods >= 2){
                    $query = DB::table('first_semester')->insert([
                        'day' => $day,
                        'time' => $time,
                        'course' => $randomCourse,
                        'lecturer' => $lecturer,
                        'class' => $class,
                        'lecture_hall' => $randomHall,
                    ]);
           
                    $query = DB::table('first_semester')->insert([
                        'day' => $day,
                        'time' => $newtime,
                        'course' => $randomCourse,
                        'lecturer' => $lecturer,
                        'class' => $class,
                        'lecture_hall' => $randomHall,
                    ]);
            }  
            if($periods >= 3){
                $query = DB::table('first_semester')->insert([
                    'day' => $npday,
                    'time' => $nptime,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class,
                    'lecture_hall' => $nprandomHall,
                ]);
            }
            if($periods == 4){
                $query = DB::table('first_semester')->insert([
                    'day' => $npday,
                    'time' => $npnewtime,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class,
                    'lecture_hall' => $nprandomHall,
                ]);
            } 
        }
        else{
            $class1 = substr($class, 0, 3);
            $class2 = substr($class, 6, 9);
            $capacity1 =  DB::table('classes')->where('name', $class1)->first()->no_of_students;
            $capacity2 =  DB::table('classes')->where('name', $class2)->first()->no_of_students;
            $capacity = $capacity1 + $capacity2;
            do{
                $clash = true;
                $loop++;

                $day = $dayarray[array_rand($dayarray)];
                $time = $timearray[array_rand($timearray)];
                $hall = Halls::inRandomOrder()->first();
                if($preferedHall == "No"){
                    $randomHall = $hall['name'];
                    }
                    else{
                        $randomHall = $preferedHall;
                    }
                $HallCapacity = $hall['capacity'];
                $newtime = Carbon::parse($time)->addHour()->format('H:i');

                $nptime1 = $timearray[array_rand($timearray)];
                $npday1 = $dayarray[array_rand($dayarray)];
                $nprandomHall1 = Halls::inRandomOrder()->first()['name'];
                $npnewtime1 = Carbon::parse($nptime1)->addHour()->format('H:i');

                $nptime2 = $timearray[array_rand($timearray)];
                $npday2 = $dayarray[array_rand($dayarray)];
                $nprandomHall2 = Halls::inRandomOrder()->first()['name'];
                $npnewtime2 = Carbon::parse($nptime2)->addHour()->format('H:i');

                //control
                $whereCondition = [
                    ['day', $day],
                    ['time', $time],
                    ['lecturer', $lecturer ]
                ];

                //control
                $whereCondition1 = [
                    ['day', $day],
                    ['time', $time],
                    ['lecture_hall', $randomHall ]
                ];

                //control
                $whereCondition3 = [
                    ['day', $day],
                    ['course', $randomCourse ],
                    ['class', $class]
                ];

                 // second period
                 $whereCondition4 = [
                    ['day', $day],
                    ['time', $newtime],
                    ['lecture_hall', $randomHall]
                ];


                //Third Period
                $whereCondition2 = [
                    ['day', $npday1],
                    ['time', $nptime1],
                    ['lecture_hall', $nprandomHall1 ]
                ];

                //Third Period
                $whereCondition21 = [
                    ['day', $npday2],
                    ['time', $nptime2],
                    ['lecture_hall', $nprandomHall2 ]
                ];

               
                //third period
                $whereCondition5 = [
                    ['day', $npday1],
                    ['time', $nptime1],
                    ['class', $class1]
                ];
                
                //third period
                $whereCondition52 = [
                    ['day', $npday2],
                    ['time', $nptime2],
                    ['class', $class2]
                ];

                //fourth period
                $whereCondition6 = [
                    ['day', $npday1],
                    ['time', $npnewtime1],
                    ['lecture_hall', $nprandomHall1]
                ];
                //fourth period
                $whereCondition62 = [
                    ['day', $npday2],
                    ['time', $npnewtime2],
                    ['lecture_hall', $nprandomHall2]
                ];
                
                if (DB::table('first_semester')->where($whereCondition)->orWhere($whereCondition1)->orWhere($whereCondition3)->exists() || $day == $npday1 || $day == $npday2) {
                    $clash = false;
                }
                if($periods >= 2 && DB::table('first_semester')->where($whereCondition2)->orWhere($whereCondition21)->orWhere($whereCondition4)->exists()){
                     $clash = false;
                 }
                if($periods >= 3 && DB::table('first_semester')->where($whereCondition5)->orWhere($whereCondition52)->where($whereCondition2)->orWhere($whereCondition21)->exists()) {
                    $clash = false;
                }
                if($periods == 4 && DB::table('first_semester')->where($whereCondition6)->orWhere($whereCondition62)->exists()){
                    $clash = false;
                }
                


            }
            while($clash == false);


            if($periods >= 2){
                $query = DB::table('first_semester')->insert([
                    'day' => $day,
                    'time' => $time,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class,
                    'lecture_hall' => $randomHall,
                ]);
       
                $query = DB::table('first_semester')->insert([
                    'day' => $day,
                    'time' => $newtime,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class,
                    'lecture_hall' => $randomHall,
                ]);
            }
            if($periods >= 3){
                $query = DB::table('first_semester')->insert([
                    'day' => $npday1,
                    'time' => $nptime1,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class1,
                    'lecture_hall' => $nprandomHall1,
                ]);

                $query = DB::table('first_semester')->insert([
                    'day' => $npday2,
                    'time' => $nptime2,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class2,
                    'lecture_hall' => $nprandomHall2,
                ]);
            }

            if($periods == 4){
                $query = DB::table('first_semester')->insert([
                    'day' => $npday1,
                    'time' => $npnewtime1,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class1,
                    'lecture_hall' => $nprandomHall1,
                ]);

                $query = DB::table('first_semester')->insert([
                    'day' => $npday2,
                    'time' => $npnewtime2,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class2,
                    'lecture_hall' => $nprandomHall2,
                ]);
            } 


        }
    }

    }

    public function secondSemester(){
        $coursesNo = Course::where('semester', 'Second')->count();
        $courses =  DB::table('courses')->where('semester', 'Second')->get();
        $timearray = ["6:00", "8:00", "10:00", "12:30", "14:30", "16:30"];
        $dayarray = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        for($i = 0; $i < $coursesNo; $i++)   
        {  set_time_limit(0);
                $randomCourse = $courses[$i]->name;
                $periods = $courses[$i]->periods;
                $lecturer = $courses[$i] -> lecturer;
                $class = $courses[$i]->class;
            if(($courses[$i]->combined) == "No"){
                
                $capacity =  DB::table('classes')->where('name', $class)->first()->no_of_students;
                do{
                    $clash = true;
                    $time = $timearray[array_rand($timearray)];
                    $day = $dayarray[array_rand($dayarray)];
                    $hall = Halls::inRandomOrder()->first();
                    $randomHall = $hall['name'];
                    $HallCapacity = $hall['capacity'];
                    $newtime = Carbon::parse($time)->addHour()->format('H:i');

                    $nptime = $timearray[array_rand($timearray)];
                    $npday = $dayarray[array_rand($dayarray)];
                    $nprandomHall = Halls::inRandomOrder()->first()['name'];
                    $npnewtime = Carbon::parse($nptime)->addHour()->format('H:i');
                    $whereCondition = [
                        ['day', $day],
                        ['time', $time],
                        ['lecturer', $lecturer ]
                    ];
                    $whereCondition1 = [
                        ['day', $day],
                        ['time', $time],
                        ['lecture_hall', $randomHall ]
                    ];
                    $whereCondition2 = [
                        ['day', $npday],
                        ['time', $nptime],
                        ['lecture_hall', $nprandomHall ]
                    ];
                   
                    $whereCondition3 = [
                        ['day', $day],
                        ['course', $randomCourse ]
                    ];
                    $whereCondition4 = [
                        ['day', $day],
                        ['time', $newtime],
                        ['lecture_hall', $randomHall]
                    ];
                    $whereCondition5 = [
                        ['day', $npday],
                        ['time', $randomCourse],
                    ];
                    $whereCondition6 = [
                        ['day', $npday],
                        ['time', $npnewtime],
                        ['lecture_hall', $nprandomHall]

                    ];
                
                if (DB::table('second_semester')->where($whereCondition)->orWhere($whereCondition1)->orWhere($whereCondition3)->exists() || $day == $npday) {
                    $clash = false;
                }
                // if(DB::table('first_semester')->where('day', $day)->where('time', $time)->where('lecture_hall',$randomHall['name'])->exists()){   
                //     $clash = false;  
                // }
                // if (DB::table('first_semester')->where('day', $npday)->where('time', $nptime)->where('lecturer',$randomCourse->lecturer)->exists()) {
                //     $clash = false;
                // }
                // if(DB::table('first_semester')->where('day', $npday)->where('time', $nptime)->where('lecture_hall',$nprandomHall['name'])->exists()){   
                //     $clash = false; 
                // }

                // if(DB::table('first_semester')->where('day', $day)->where('course',$randomCourse->name)->exists()){
                //     $clash = false;
                // }
                if($periods >= 2 && DB::table('second_semester')->where($whereCondition4)->exists()){
                    $clash = false;
                }
                if($periods >= 3 && DB::table('second_semester')->where($whereCondition5)->orWhere($whereCondition2)->exists()) {
                    $clash = false;
                }
                if($periods == 4 && DB::table('second_semester')->where($whereCondition6)->exists()){
                    $clash = false;
                }
                }
                while($clash == false);
                if($periods >= 2){
                        $query = DB::table('second_semester')->insert([
                            'day' => $day,
                            'time' => $time,
                            'course' => $randomCourse,
                            'lecturer' => $lecturer,
                            'class' => $class,
                            'lecture_hall' => $randomHall,
                        ]);
            
                        $query = DB::table('second_semester')->insert([
                            'day' => $day,
                            'time' => $newtime,
                            'course' => $randomCourse,
                            'lecturer' => $lecturer,
                            'class' => $class,
                            'lecture_hall' => $randomHall,
                        ]);
                }  
                if($periods >= 3){
                    $query = DB::table('second_semester')->insert([
                        'day' => $npday,
                        'time' => $nptime,
                        'course' => $randomCourse,
                        'lecturer' => $lecturer,
                        'class' => $class,
                        'lecture_hall' => $nprandomHall,
                    ]);
                }
                if($periods == 4){
                    $query = DB::table('second_semester')->insert([
                        'day' => $npday,
                        'time' => $npnewtime,
                        'course' => $randomCourse,
                        'lecturer' => $lecturer,
                        'class' => $class,
                        'lecture_hall' => $nprandomHall,
                    ]);
                } 
        }
        else{
            $class1 = substr($class, 0, 3);
            $class2 = substr($class, 6, 9);
            $capacity1 =  DB::table('classes')->where('name', $class1)->first()->no_of_students;
            $capacity2 =  DB::table('classes')->where('name', $class2)->first()->no_of_students;
            $capacity = $capacity1 + $capacity2;
            do{
                $clash = true;

                $day = $dayarray[array_rand($dayarray)];
                $time = $timearray[array_rand($timearray)];
                $hall = Halls::inRandomOrder()->first();
                $randomHall = $hall['name'];
                $HallCapacity = $hall['capacity'];
                $newtime = Carbon::parse($time)->addHour()->format('H:i');

                $nptime1 = $timearray[array_rand($timearray)];
                $npday1 = $dayarray[array_rand($dayarray)];
                $nprandomHall1 = Halls::inRandomOrder()->first()['name'];
                $npnewtime1 = Carbon::parse($nptime1)->addHour()->format('H:i');

                $nptime2 = $timearray[array_rand($timearray)];
                $npday2 = $dayarray[array_rand($dayarray)];
                $nprandomHall2 = Halls::inRandomOrder()->first()['name'];
                $npnewtime2 = Carbon::parse($nptime2)->addHour()->format('H:i');

                $whereCondition = [
                    ['day', $day],
                    ['time', $time],
                    ['lecturer', $lecturer ]
                ];
                $whereCondition1 = [
                    ['day', $day],
                    ['time', $time],
                    ['lecture_hall', $randomHall ]
                ];
                $whereCondition2 = [
                    ['day', $npday1],
                    ['time', $nptime1],
                    ['lecture_hall', $nprandomHall1 ]
                ];

                $whereCondition21 = [
                    ['day', $npday2],
                    ['time', $nptime2],
                    ['lecture_hall', $nprandomHall2 ]
                ];

                $whereCondition3 = [
                    ['day', $day],
                    ['course', $randomCourse ],
                    ['class', $class]
                ];
                $whereCondition4 = [
                    ['day', $day],
                    ['time', $newtime],
                    ['lecture_hall', $randomHall]
                ];
                $whereCondition5 = [
                    ['day', $npday1],
                    ['time', $randomCourse],
                    ['class', $class1]
                ];
                $whereCondition52 = [
                    ['day', $npday2],
                    ['time', $randomCourse],
                    ['class', $class2]
                ];
                $whereCondition6 = [
                    ['day', $npday1],
                    ['time', $npnewtime1],
                    ['lecture_hall', $nprandomHall1]
                ];
                $whereCondition62 = [
                    ['day', $npday2],
                    ['time', $npnewtime2],
                    ['lecture_hall', $nprandomHall2]
                ];
                
                if (DB::table('first_semester')->where($whereCondition)->orWhere($whereCondition1)->exists()) {
                    $clash = false;
                }
                if($periods >= 2 && DB::table('first_semester')->where($whereCondition4)->orWhere($whereCondition3)->exists()){
                     $clash = false;
                 }
                if($periods >= 3 && DB::table('first_semester')->where($whereCondition2)->orWhere($whereCondition21)->orWhere($whereCondition5)->orWhere($whereCondition52)->exists()) {
                    $clash = false;
                }
                if($periods == 4 && DB::table('first_semester')->where($whereCondition6)->orWhere($whereCondition62)->exists()){
                    $clash = false;
                }


            }
            while($clash == false);


            if($periods >= 2){
                $query = DB::table('first_semester')->insert([
                    'day' => $day,
                    'time' => $time,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class,
                    'lecture_hall' => $randomHall,
                ]);
       
                $query = DB::table('first_semester')->insert([
                    'day' => $day,
                    'time' => $newtime,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class,
                    'lecture_hall' => $randomHall,
                ]);
            }
            if($periods >= 3){
                $query = DB::table('first_semester')->insert([
                    'day' => $npday1,
                    'time' => $nptime1,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class1,
                    'lecture_hall' => $nprandomHall1,
                ]);

                $query = DB::table('first_semester')->insert([
                    'day' => $npday2,
                    'time' => $nptime2,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class2,
                    'lecture_hall' => $nprandomHall2,
                ]);
            }

            if($periods == 4){
                $query = DB::table('first_semester')->insert([
                    'day' => $npday1,
                    'time' => $npnewtime1,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class1,
                    'lecture_hall' => $nprandomHall1,
                ]);

                $query = DB::table('first_semester')->insert([
                    'day' => $npday2,
                    'time' => $npnewtime2,
                    'course' => $randomCourse,
                    'lecturer' => $lecturer,
                    'class' => $class2,
                    'lecture_hall' => $nprandomHall2,
                ]);
            } 


        }
    }

    }

    public function generateTimetable(Request $request)
    {
        $request -> validate([
            'semester' => 'required',
        ]);
        Admin::where('id', '=', session('LoggedUser'));
        $user = Admin::find(session('LoggedUser'));
        $semester = $request->input('semester');
        if($semester == "First"){
            DB::table('first_semester')->truncate();
            $this->firstSemester();
            $user->recent = 'First';
            $user->save();
            return back()->with('success', 'New timetable generated successfully');
        }
        elseif($semester == "Second"){
            DB::table('second_semester')->truncate();
            $this->secondSemester();
            $user->recent = 'Second';
            $user->save();
            return back()->with('success', 'New timetable generated successfully'); 
        }
        
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
     * @param  \App\Models\Generator  $generator
     * @return \Illuminate\Http\Response
     */
    public function show(Generator $generator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Generator  $generator
     * @return \Illuminate\Http\Response
     */
    public function edit(Generator $generator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Generator  $generator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Generator $generator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Generator  $generator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Generator $generator)
    {
        //
    }
}
