<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Nomination;
use Illuminate\Http\Request;

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

    public static function nominations()
    {
        $data = AdministrationController::getNominationsData();
        return view('administration/nominations', ["nominations" => $data, "search" => ""]);
    }

    public function nominationsSearch(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            return AdministrationController::nominations();
        } else {

            $data = AdministrationController::getNominationsData();

            $data = array_filter(
                $data,
                function ($var) use ($search, $data) {
                    return AdministrationController::array_any($data, function ($alias) use ($search) {
                            return str_contains(strtolower($alias['nominee_first_name']), strtolower($search));
                        }) ||
                        AdministrationController::array_any($data, function ($alias) use ($search) {
                            return str_contains(strtolower($alias['nominee_last_name']), strtolower($search));
                        });
                }
            );
            return view('administration/nominations', ["nominations" => $data, "search" => $search]);
        }
    }

    private static function getNominationsData()
    {
        $nominations = Nomination::all()->toArray();
        $faculties = Faculty::all();
        $data = [];

        foreach ($nominations as $nomination) {
            $nomination['faculty'] = $faculties->find($nomination['faculty_id']);
            array_push($data, $nomination);
        }

        return $data;

    }

    private static function array_any(array $array, callable $fn)
    {
        foreach ($array as $value) {
            if ($fn($value)) {
                return true;
            }
        }
        return false;
    }
}
