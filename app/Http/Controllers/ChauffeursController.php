<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use App\Models\Chauffeur;
use App\Http\Requests\ChauffeurRequest;
use App\Models\Vehicule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Foundation\Auth\AuthenticatesUsers;

class ChauffeursController extends Controller
{

    use AuthenticatesUsers;

    /*protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chauffeurs= Chauffeur::all();
        return view('chauffeurs.index', ['chauffeurs'=>$chauffeurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicules = Vehicule::all()->pluck('marque', 'id');
        return view('chauffeurs.create')->with('vehicules', $vehicules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ChauffeurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChauffeurRequest $request)
    {
        $rules = [  'email' => [ 'required','email'] ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $chauffeur = new Chauffeur;
		$chauffeur->nom = $request->input('nom');
		$chauffeur->prenom = $request->input('prenom');
		$chauffeur->adresse = $request->input('adresse');
		$chauffeur->email = $request->input('email');
		$chauffeur->tel = $request->input('tel');
		$chauffeur->date_naissance = $request->input('date_naissance');
		$chauffeur->num_permis = $request->input('num_permis');
		$chauffeur->vehicule_id = $request->input('vehicule');
        $chauffeur->save();

        $user = new User();
        $user->name = $request->input('nom')." ".$request->input('prenom');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = 2;
        $user->save();
        $this->guard()->logout();

        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chauffeur = Chauffeur::findOrFail($id);
        return view('chauffeurs.show',['chauffeur'=>$chauffeur]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chauffeur = Chauffeur::findOrFail($id);
        return view('chauffeurs.edit',['chauffeur'=>$chauffeur]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ChauffeurRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChauffeurRequest $request, $id)
    {
        $chauffeur = Chauffeur::findOrFail($id);
		$chauffeur->nom = $request->input('nom');
		$chauffeur->prenom = $request->input('prenom');
		$chauffeur->adresse = $request->input('adresse');
		$chauffeur->email = $request->input('email');
		$chauffeur->tel = $request->input('tel');
		$chauffeur->date_naissance = $request->input('date_naissance');
		$chauffeur->num_permis = $request->input('num_permis');
		$chauffeur->etat = $request->input('etat');
        $chauffeur->save();

        return redirect()->route('chauffeurs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chauffeur = Chauffeur::findOrFail($id);
        $chauffeur->delete();

        return redirect()->route('chauffeurs.index');
    }
}
