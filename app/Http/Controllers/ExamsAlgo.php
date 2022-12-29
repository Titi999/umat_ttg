<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Course;
use Carbon\CarbonPeriod;
use App\Models\Halls;
use App\Models\Exams;
use App\Models\Lecturer;

class ExamsAlgo extends Controller
{
    //
    function index(){
        $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()];
        $examsList = Exams::orderBy('date', 'ASC')->get();
        $colors = ['red', 'yellow', 'green', 'blue', 'redlike', 'yellowlike', 'bluelike', 'greenlike'];
        return view('admin.exams', $data, compact('examsList'));
    }

    function generateExams(Request $request){
        Exams::truncate();

        //check if all fields of form is filled
        $request -> validate([
            'semester' => 'required',
            'startDate' => 'required',
            'endDate' => 'required'
        ]);
        
        //Time of exams
        $timearray = ["Morning", "Afternoon", "Evening"];
       

        //get all dates between start date and end date
        $period = CarbonPeriod::create($request->input('startDate'), $request->input('endDate'))->toArray();

        //get all combined courses - Combined courses are inserted first according to UMaT
        $combinedCourses = Course::where('combined', 'Yes')->get();

        //loop through combined courses
        for($i = 0; $i < Course::where('combined', 'Yes')->count(); $i++){

            //check if course already exists in the exams database
            if(Exams::where('course',  $combinedCourses[$i]['name'])->exists()){
                continue;
            }

            //if course does not exists in exams database

            //get all courses with same name
            $course = Course::where('name', $combinedCourses[$i]['name'])->get();
            $courseName = Course::where('name', $combinedCourses[$i]['name'])->first()->name;
            $courseNo = Course::where('name', $combinedCourses[$i]['name'])->first()->code;

            //an array of the classes taking that particular course
            $classes = [];

            //loop through current course name
            for($j = 0; $j < count($course); $j++){
                //get class from combined course
                $courseClass = explode('&', $course[$j]['class']);
                $classes[$courseClass[0]] = $course[$j]['class'];
                $classes[$courseClass[1]] = $course[$j]['class'];
                // add classes to classes taking the course array
                //$classes = array_merge($classes, $courseClass);
                
            }

            // foreach ($period as $date) {
            //     $name_of_the_day = date('l', strtotime($date));
            //     if($name_of_the_day == "Sunday"){
            //         continue;
            //     }
            //     else{
            //         $examsDate = $date;
                    
            //     }
                
            // }
            

            
            $examsDate = $period[array_rand($period)];
           // dd($examsDate);
            //allot each combined course class a slot
            foreach ($classes as $class => $combinedClasses) {
                do{
                    $clash = false;
                    $lecturer = Course::where([['name', $courseName], ['class', $combinedClasses]])->first()->lecturer;
                    $hall = Halls::inRandomOrder()->first()->name;
                    $invigilator = Lecturer::inRandomOrder()->first()->name;
                    $time = $timearray[array_rand($timearray)];
                $where = [
                    ['date', $examsDate],
                    ['hall', $hall],
                    ['time', $time]
                ];
    
                $where1 = [
                    ['date', $examsDate],
                    ['invigilator', $invigilator]
                ];

                if(Exams::where($where)->orWhere($where1)->exists()){
                    $clash = true;
                }

                }
                while($clash == true);

                $exam = new Exams;
                $exam->date = $examsDate;
                $exam->course = $courseName;
                $exam->course_no = $courseNo;
                $exam->class = $class;
                $exam->capacity = 50;
                $exam->lecturer = $lecturer;
                $exam->hall = $hall;
                $exam->invigilator = $invigilator;
                $exam->time = $time;
				$exam->save();
            }


            
        }

        $Courses = Course::where('combined', 'No')->get();
        for($i = 0; $i < Course::where('combined', 'No')->count(); $i++){
            $course = Course::where('name', $Courses[$i]['name'])->get();
            $courseName = Course::where('name', $Courses[$i]['name'])->first()->name;
            $courseNo = Course::where('name', $Courses[$i]['name'])->first()->code;
            $class = Course::where('name', $Courses[$i]['name'])->first()->class;

            if(Exams::where('course',  $Courses[$i]['name'])->exists()){
                continue;
            }

            // foreach ($period as $date) {
            //     $name_of_the_day = date('l', strtotime($date));
            //     if($name_of_the_day == "Sunday"){
            //         continue;
            //     }
            //     else{
            //         $examsDate = $date;
                    
            //     }
            // } 
            $lecturer = Course::where('name', $courseName)->first()->lecturer;
           
            do{
                $clash = false;
            $examsDate = $period[array_rand(array($period))];
            $hall = Halls::inRandomOrder()->first()->name;
            $time = $timearray[array_rand($timearray)];
            $invigilator = Lecturer::inRandomOrder()->first()->name;
            $where = [
                ['date', $examsDate],
                ['hall', $hall],
                ['time', $time]
            ];

            $where1 = [
                ['date', $examsDate],
                ['invigilator', $invigilator]
            ];


                if(Exams::where($where)->orWhere($where1)->exists()){
                    $clash = false;
                }

            }
            while($clash == true);

                $exam = new Exams;
                $exam->date = $examsDate;
                $exam->course = $courseName;
                $exam->course_no = $courseNo;
                $exam->class = $class;
                $exam->capacity = 50;
                $exam->lecturer = $lecturer;
                $exam->hall = $hall;
                $exam->invigilator = $invigilator;
                $exam->time = $time;
				$exam->save();

                

        }
        return back()->with('success', 'Exams timetable generated successfully'); 

    }
}
