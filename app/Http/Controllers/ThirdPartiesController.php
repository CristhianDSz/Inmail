<?php

namespace App\Http\Controllers;

use App\ThirdParty;

class ThirdPartiesController extends Controller
{
    public function render()
    {
        return view('third_parties.index');
    }

    public function index()
    {
        return ThirdParty::orderBy('name')->paginate(30);
    }

    public function getData()
    {
        return ThirdParty::orderBy('name')->get();
    }

    public function store()
    {
        $attributes = request()->validate([
            'identification' => 'required|min:8|unique:third_parties,identification',
            'name' => 'required|string|min:3',
            'address' => 'required||min:3',
            'telephone' => 'required|numeric',
            'city' => 'required|min:3',
            'email_contact' => 'required|email',
        ]);

        ThirdParty::create($attributes);

        return response()->json(['message' => 'Tercero creado correctamente'], 201);
    }

    public function update(ThirdParty $thirdParty)
    {

        $attributes = request()->validate([
            'identification' => 'required|min:8|unique:third_parties,identification,' . $thirdParty->id,
            'name' => 'required|string|min:3',
            'address' => 'required||min:3',
            'telephone' => 'required|numeric',
            'city' => 'required|min:3',
            'email_contact' => 'required|email',
        ]);

        $thirdParty->update($attributes);

        return response()->json(['message' => 'Tercero actualizado correctamente!'], 200);
    }

    public function destroy(ThirdParty $thirdParty)
    {
        $thirdParty->delete();

        return response()->json(['message' => 'Tercero eliminado correctamente!'], 200);
    }
}
