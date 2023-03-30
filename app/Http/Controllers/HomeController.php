<?php

namespace App\Http\Controllers;

use App\Models\Chauffeur;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome()
    {
        return view('adminHome');
    }
  
    public function chauffeurHome()
    {
        return view('chauffeurHome');
    }

    public function monCompte($id)
    {
        $user = User::find($id);
        if ($user->type == 'client') { $user0 = Client::where('email', $user->email)->first(); }
        if ($user->type == 'chauffeur') { $user0 = Chauffeur::where('email', $user->email)->first(); }
        if ($user->type == 'admin') { $user0 = $user; }

        return view('compte', compact('user', 'user0'));
    }

    public function editCompte($id, $type)
    {
        if ($type == 'client') { $user = Client::find($id); }
        if ($type == 'chauffeur') { $user = Chauffeur::find($id); }

        return view('editCompte', compact('user'));
    }

    public function updateCompte(Request $request, $id, $type)
    {
        if ($type == 'client') {
            $user = Client::find($id);
            $user->num_compte = $request->input('num_compte');
        } else {
            $user = Chauffeur::find($id);
            $user->num_permis = $request->input('num_permis');
        }
        $user->nom = $request->input('nom');
		$user->prenom = $request->input('prenom');
		$user->adresse = $request->input('adresse');
		$user->tel = $request->input('tel');
		$user->date_naissance = $request->input('date_naissance');
        $user->save();
        
        return redirect()->route('mon_compte');
    }
}
