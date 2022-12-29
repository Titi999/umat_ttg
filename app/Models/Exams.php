<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'course',
        'course_no',
        'class',
        'capacity',
        'lecturer',
        'hall',
        'invigilator'
   ];
}
