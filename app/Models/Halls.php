<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halls extends Model
{
    use HasFactory;
    protected $fillable = [
         'name',
         'capacity',
         'average_classes',
         'amenities',
         'status'
    ];

}
