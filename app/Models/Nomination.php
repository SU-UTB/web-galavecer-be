<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    use HasFactory;

    protected $table = 'nominations';
    protected $fillable = [
        'recommendator_first_name',
        'recommendator_last_name',
        'faculty_id',
        'category_id',
        'nominee_first_name',
        'nominee_last_name',
        'nominee_email',
        'achievements'
    ];
}