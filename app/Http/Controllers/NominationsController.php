<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Nomination;
use Illuminate\Http\Request;

class NominationsController extends Controller
{
    public static function index()
    {
        $faculties = Faculty::all();
        return response()->json(array(
            'faculties' => $faculties->toArray()
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required'],
            'facultyNominated' => ['required'],
            'firstNameNominated' => ['required'],
            'lastNameNominated' => ['required'],
            'achievementsNominated' => ['required']
        ]);

        $emailValidation = $this->validateEmailDomain($request->input('email'));

        if ($emailValidation === false) {
            return response()->json([
                'error' => 'Email has not allowed domain!',
                'allowed_domains' => array('utb.cz')
            ], 400);
        }

        $nomination = Nomination::create([
            'recommendator_first_name' => $request->input('firstName'),
            'recommendator_last_name' => $request->input('lastName'),
            'recommendator_email' => $request->input('email'),
            'faculty_id' => (int)$request->input('facultyNominated'),
            'nominee_first_name' => $request->input('firstNameNominated'),
            'nominee_last_name' => $request->input('lastNameNominated'),
            'achievements' => $request->input('achievementsNominated'),
        ]);

        $data = ['nomination' => $nomination];

        return response()->json($data, 200);
    }


    function validateEmailDomain($email): bool
    {
        $domains = array("utb.cz");

        foreach ($domains as $domain) {
            $pos = strpos($email, $domain, strlen($email) - strlen($domain));

            if ($pos === false)
                continue;

            if ($pos == 0 || $email[(int)$pos - 1] == "@" || $email[(int)$pos - 1] == ".")
                return true;
        }

        return false;
    }
}
