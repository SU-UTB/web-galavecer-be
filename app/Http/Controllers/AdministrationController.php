<?php

namespace App\Http\Controllers;

use App\Models\Nomination;

class AdministrationController extends Controller
{
    public function dashboard()
    {
        $nominations = Nomination::all();

        return view('dashboard', [
            "nominatedTotal" => $nominations->count(),
            "nominatedFT" => $nominations->where('faculty_id', '=', 1)->count(),
            "nominatedFAME" => $nominations->where('faculty_id', '=', 2)->count(),
            "nominatedFMK" => $nominations->where('faculty_id', '=', 3)->count(),
            "nominatedFAI" => $nominations->where('faculty_id', '=', 4)->count(),
            "nominatedFHS" => $nominations->where('faculty_id', '=', 5)->count(),
            "nominatedFLKR" => $nominations->where('faculty_id', '=', 6)->count()
        ]);
    }

}
