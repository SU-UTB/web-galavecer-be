<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faculty;
use App\Models\Nomination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="SU Galavecer - Api Documentation",
 *     description="Api Documentation for UTB Gala Ball",
 *     @OA\Contact(
 *         name="Sedlar David",
 *         email="sedlar@sutb.cz"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * ),
 * @OA\Server(
 *     url="/api/v1",
 * ),
 */
class NominationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    /**
     * @OA\Get(
     *    path="/api/nominations",
     *    operationId="index",
     *    tags={"Nominations"},
     *    summary="Get data for nominations index page",
     *    description="Gets list of faculties to render",
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     *  )
     */
    public static function index()
    {
        $faculties = Faculty::all();
        $categories = Category::all();
        return response()->json(
            array(
                'faculties' => $faculties->toArray(),
                'categories' => $categories->toArray()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    /**
     * @OA\Post(
     *   tags={"Nominations"},
     *   path="/api/nominations",
     *   summary="Creates a nomination",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="firstName",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="lastName",
     *                     type="string"
     *                 ),
     *                   @OA\Property(
     *                     property="facultyNominated",
     *                     type="integer"
     *                 ),
     *                    @OA\Property(
     *                     property="categoryNominated",
     *                     type="integer"
     *                 ),
     *            @OA\Property(
     *                     property="firstNameNominated",
     *                     type="string"
     *                 ),
     *            @OA\Property(
     *                     property="lastNameNominated",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="emailNominated",
     *                     type="string"
     *                 ),
     *            @OA\Property(
     *                     property="achievementsNominated",
     *                     type="string"
     *                 ),
     *                 example={"firstName": "David", "lastName": "sedlar", "facultyNominated" : 1, "categoryNominated" : 2, "firstNameNominated" : "Filip" , "lastNameNominated" :"Tomes",  "emailNominated" : "tomes@utb.cz" ,"achievementsNominated" :"Popici kluk to je"}
     *             )
     *         )
     *     ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */

    public function store(Request $request)
    {
        $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'facultyNominated' => ['required'],
            'categoryNominated' => ['required'],
            'firstNameNominated' => ['required'],
            'lastNameNominated' => ['required'],
            'emailNominated' => ['required'],
            'achievementsNominated' => ['required']
        ]);

        $emailValidation = $this->validateEmailDomain($request->input('emailNominated'));

        if ($emailValidation === false) {
            return response()->json([
                'error' => 'Email has not allowed domain!',
                'allowed_domains' => array('utb.cz')
            ], 400);
        }

        $nomination = Nomination::create([
            'recommendator_first_name' => $request->input('firstName'),
            'recommendator_last_name' => $request->input('lastName'),
            'faculty_id' => (int) $request->input('facultyNominated'),
            'category_id' => (int) $request->input('categoryNominated'),
            'nominee_first_name' => $request->input('firstNameNominated'),
            'nominee_last_name' => $request->input('lastNameNominated'),
            'nominee_email' => $request->input('emailNominated'),
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

            if ($pos == 0 || $email[(int) $pos - 1] == "@" || $email[(int) $pos - 1] == ".")
                return true;
        }

        return false;
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return Nomination::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $nomination = Nomination::find($id);
        $nomination->update($request->all());
        return $nomination;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        return Nomination::destroy($id);
    }

    public function remove(Request $request, $id)
    {
        $this->destroy($id);
        return AdministrationController::nominations();
    }
}