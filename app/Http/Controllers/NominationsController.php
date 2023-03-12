<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class NominationsController extends Controller
{
    public static function index()
    {
        $faculties = Faculty::all()->toArray();
        return response()->json($faculties, 200);
    }
}