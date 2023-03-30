<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Models\Chauffeur;
use App\Models\Paiement;
use App\Models\Client;
use App\Models\Evaluation;
use App\Models\User;

use function PHPUnit\Framework\returnValueMap;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations= Reservation::all();
        return view('reservations.index', ['reservations'=>$reservations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {

        $rules = [ ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($request->input('client_id'));
        $client = Client::where('email', $user->email)->first();

        $reservation = new Reservation;
		$reservation->client_id = $client->id;
		$reservation->dure = $request->input('dure');
		$reservation->distance = $request->input('distance');
		$reservation->adresse_depart = $request->input('adresse_depart');
		$reservation->adresse_arrivee = $request->input('adresse_arrivee');
		$reservation->d_longitude = $request->input('d_longitude');
		$reservation->d_latitude = $request->input('d_latitude');
		$reservation->a_longitude = $request->input('a_longitude');
		$reservation->a_latitude = $request->input('a_latitude');
		$reservation->prix = $request->input('prix');
	
        $reservation->save();

        $paiement = new Paiement();
        $paiement->reservation_id = $reservation->id;
        $paiement->montant = $request->input('prix');
        $paiement->mode = $request->input('mode_paiement');
        if ($request->input('mode_paiement') == "Wave" || $request->input('mode_paiement') == "Orange_Money") {
            $paiement->debiteur = $client->tel;
        } elseif ($request->input('mode_paiement') == "Carte_Credit") {
           $paiement->debiteur = $client->num_compte;
        } else {
            $paiement->debiteur = "0";
        }
        $paiement->save();

        return redirect()->route('reservations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.show', ['reservation'=>$reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit',['reservation'=>$reservation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReservationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
		$reservation->client_id = $request->input('client_id');
		$reservation->chauffeur_id = $request->input('chauffeur_id');
		$reservation->dure = $request->input('dure');
		$reservation->adresse_depart = $request->input('adresse_depart');
		$reservation->adresse_arrivee = $request->input('adresse_arrivee');
		$reservation->d_longitude = $request->input('d_longitude');
		$reservation->d_latitude = $request->input('d_latitude');
		$reservation->a_longitude = $request->input('a_longitude');
		$reservation->a_latitude = $request->input('a_latitude');
		$reservation->prix = $request->input('prix');
		$reservation->etat = $request->input('etat');
        $reservation->save();

        return redirect()->route('reservations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index');
    }

    public function courseClient()
    {
        $reservations = Reservation::all();
        $evaluations = Evaluation::all();
        return view('clients.reservation', compact('reservations', 'evaluations'));
    }

    public function courseChauffeur()
    {
        $reservations = Reservation::all();

        return view('chauffeurs.reservation', compact('reservations'));
    }

    public function priseCourseChauffeur($id_reservation, $id_chauffeur)
    {
        $reservation = Reservation::find($id_reservation);
        $user = User::find($id_chauffeur);
        $chauffeur = Chauffeur::where('email', $user->email)->first();
        $reservation->chauffeur_id = $chauffeur->id;
        $reservation->etat = "C";
        $reservation->update();

        return redirect()->route('chauffeur.reservations');
    }

    public function finCourseChauffeur($id)
    {
        $reservation = Reservation::find($id);
        $reservation->etat = "T";
        $reservation->update();

        return redirect()->route('chauffeur.reservations');
    }
}
