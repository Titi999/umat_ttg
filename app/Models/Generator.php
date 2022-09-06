<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generator extends Model
{
    use HasFactory;
    protected $fillable = [
        'time',
        'course',
        'lecturer',
        'class',
        'lecture_hall',
   ];
}
