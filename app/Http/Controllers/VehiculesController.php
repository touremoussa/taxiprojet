<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Vehicule;
use App\Http\Requests\VehiculeRequest;
use App\Models\Chauffeur;
use App\Models\User;

class VehiculesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicules= Vehicule::all();
        return view('vehicules.index', ['vehicules'=>$vehicules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VehiculeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculeRequest $request)
    {
        $vehicule = new Vehicule;
		$vehicule->marque = $request->input('marque');
		$vehicule->couleur = $request->input('couleur');
		$vehicule->places = $request->input('places');
        $vehicule->save();

        return redirect()->route('vehicules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicules.show',['vehicule'=>$vehicule]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicules.edit',['vehicule'=>$vehicule]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VehiculeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehiculeRequest $request, $id)
    {
        $vehicule = Vehicule::findOrFail($id);
		$vehicule->marque = $request->input('marque');
		$vehicule->couleur = $request->input('couleur');
		$vehicule->places = $request->input('places');
        $vehicule->save();

        return redirect()->route('vehicules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->delete();

        return redirect()->route('vehicules.index');
    }

    public function vehiculeChauffeur($id)
    {
        $user = User::find($id);
        $chauffeur = Chauffeur::where('email', $user->email)->first();
        $vehicules = Vehicule::all();

        return view('chauffeurs.vehicule', compact('chauffeur', 'vehicules'));
    }
}
