<?php

namespace App\Http\Controllers;

use App\Models\Nominee;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class NomineesController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function update(Request $request, $id)
    {
        $nomination = Nominee::find($id);
        $nomination->update([
            'achievements' => $request->input('achievements')
        ]);
        return AdministrationController::nominees();
    }
}
