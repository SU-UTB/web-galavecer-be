<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Nomination;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public static function nominations()
    {
        $data = AdministrationController::getNominationsData();
        return view('dashboard', ['nominations' => $data]);
    }

    public function delete($id)
    {
        $nomination = Nomination::where('id', '=', $id)->get();
        $nomination->destroy($id);
        return AdministrationController::nominations();
    }

    private static function getNominationsData()
    {
        $nominations = Nomination::all()->toArray();
        foreach ($nominations as $nomination) {
            $faculty = Faculty::where('id', '=', $nomination['faculty_id'])->first();
            $nomination['faculty'] = $faculty->faculty_name;
        }
        return $nominations;
    }
}
