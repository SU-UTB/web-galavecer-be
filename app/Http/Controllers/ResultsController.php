<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Nominee;
use App\Models\Vote;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    /**
     * @OA\Get(
     *    path="/api/results",
     *    operationId="index",
     *    tags={"Results"},
     *    summary="Get data for results index page",
     *    description="Gets list of top 3 nominees to render",
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     *  )
     */
    public static function index()
    {
        $nominees = Nominee::all();
        $faculties = Faculty::all();
        $votes = Vote::all();
        $data = [];

        foreach ($nominees as $nominee) {
            $nominee['faculty'] = $faculties->find($nominee['faculty_id']);
            $nominee['votes'] = $votes->where('nominee_id', $nominee['id'])->where('isFake', 0)->count();
            array_push($data, $nominee);
        }

        usort(
            $data,
            function ($a, $b) {
                return $b['votes'] - $a['votes'];
            }
        );

        $data = array_slice($data, 0, 3);

        return response()->json(
            array(
                'results' => $data
            )
        );
    }
}