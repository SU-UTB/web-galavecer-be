<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public static function nominations()
    {
        $data = AdministrationController::getNominationsData();
        return view('administration/nominations', ['nominations" => $data']);
    }

    private static function getNominationsData()
    {
        return $nominations = Nomination::all()->toArray();
    }
}
