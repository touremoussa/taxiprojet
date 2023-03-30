<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Paiement;
use App\Http\Requests\PaiementRequest;

class PaiementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paiements= Paiement::all();
        return view('paiements.index', ['paiements'=>$paiements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paiements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PaiementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaiementRequest $request)
    {
        $paiement = new Paiement;
		$paiement->reservation_id = $request->input('reservation_id');
		$paiement->montant = $request->input('montant');
		$paiement->mode = $request->input('mode');
        $paiement->save();

        return redirect()->route('paiements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paiement = Paiement::findOrFail($id);
        return view('paiements.show',['paiement'=>$paiement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paiement = Paiement::findOrFail($id);
        return view('paiements.edit',['paiement'=>$paiement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PaiementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaiementRequest $request, $id)
    {
        $paiement = Paiement::findOrFail($id);
		$paiement->reservation_id = $request->input('reservation_id');
		$paiement->montant = $request->input('montant');
		$paiement->mode = $request->input('mode');
        $paiement->save();

        return redirect()->route('paiements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('paiements.index');
    }
}
