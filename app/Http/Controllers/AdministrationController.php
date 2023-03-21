<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faculty;
use App\Models\Nomination;
use App\Models\Nominee;
use App\Models\Vote;
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

    public static function nominees()
    {
        $data = AdministrationController::getNomineesData();
        return view('administration/nominees', ["nominees" => $data, "search" => ""]);
    }

    public static function votes()
    {
        $data = AdministrationController::getVotesData();
        return view('administration/votes', ["votes" => $data, "search" => ""]);
    }

    public function nomineesSearch(Request $request)
    {
        $search = $request->input('search');

        if ($search == '') {
            return AdministrationController::nominees();
        } else {

            $data = AdministrationController::getNomineesData();

            $data = array_filter(
                $data,
                function ($var) use ($search, $data) {
                    return AdministrationController::array_any(
                        $data,
                        function ($alias) use ($search) {
                                return str_contains(strtolower($alias['nominee_first_name']), strtolower($search));
                            }
                    ) ||
                        AdministrationController::array_any(
                            $data,
                            function ($alias) use ($search) {
                                    return str_contains(strtolower($alias['nominee_last_name']), strtolower($search));
                                }
                        ) ||
                        AdministrationController::array_any(
                            $data,
                            function ($alias) use ($search) {
                                    return str_contains(strtolower($alias['nominee_email']), strtolower($search));
                                }
                        );
                }
            );
            return view('administration/nominees', ["nominees" => $data, "search" => $search]);
        }
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
                    return AdministrationController::array_any(
                        $data,
                        function ($alias) use ($search) {
                                return str_contains(strtolower($alias['nominee_first_name']), strtolower($search));
                            }
                    ) ||
                        AdministrationController::array_any(
                            $data,
                            function ($alias) use ($search) {
                                    return str_contains(strtolower($alias['nominee_last_name']), strtolower($search));
                                }
                        ) ||
                        AdministrationController::array_any(
                            $data,
                            function ($alias) use ($search) {
                                    return str_contains(strtolower($alias['nominee_email']), strtolower($search));
                                }
                        );
                }
            );
            return view('administration/nominations', ["nominations" => $data, "search" => $search]);
        }
    }

    private static function getNomineesData()
    {
        $nominees = Nominee::all();
        if (count($nominees) === 0) {

        }
        $faculties = Faculty::all();
        $data = [];

        foreach ($nominees as $nominee) {
            $nominee['faculty'] = $faculties->find($nominee['faculty_id']);
            array_push($data, $nominee);
        }
        return $data;
    }

    private static function FillNomineesTable()
    {
        $response = Nomination::selectRaw('nominee_email, GROUP_CONCAT(DISTINCT achievements SEPARATOR " ") as achievements')
            ->groupBy('nominee_email')
            ->get(); //without categories sportovec/sportovni tym
        //no idea
    }

    private static function getVotesData()
    {
        $nominees = Nominee::all();
        $votes = Vote::all();
        $data = [];

        foreach ($votes as $vote) {
            $vote['nominee'] = $nominees->find($vote['nominee_id']);
            array_push($data, $vote);
        }

        return $data;
    }

    private static function getNominationsData()
    {
        $nominations = Nomination::all()->toArray();
        $faculties = Faculty::all();
        $categories = Category::all();
        $data = [];

        foreach ($nominations as $nomination) {
            $categoryId = $nomination['category_id'];
            if ($categoryId === 8) {
                $categoryId = 7;
            }
            $nomination['faculty'] = $faculties->find($nomination['faculty_id']);
            $nomination['category'] = $categories->find($categoryId);
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