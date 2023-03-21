<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $table = 'nominees';
    protected $fillable = [
        'first_name',
        'last_name',
        'faculty_id',
        'achievements'
    ];
}