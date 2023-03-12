<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public static function nominations()
    {
        $data = AdministrationController::getNominationsData();
        return view('administration/nominations', ['nominations => $data']);
    }

    public function delete(Request $request, $id)
    {
        $nomination = Nomination::where('id', '=', $id)->get();
        $this->destroy($id);
        return AdministrationController::nominations();
    }

    private static function getNominationsData()
    {
        return $nominations = Nomination::all()->toArray();
    }
}
