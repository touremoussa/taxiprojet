<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ClientRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
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
        $clients= Client::all();
        return view('clients.index', ['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {

        $rules = [  'email' => [ 'required','email'] ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = new Client;
		$client->nom = $request->input('nom');
		$client->prenom = $request->input('prenom');
		$client->adresse = $request->input('adresse');
		$client->sexe = $request->input('sexe');
		$client->email = $request->input('email');
		$client->tel = $request->input('tel');
		$client->date_naissance = $request->input('date_naissance');
		$client->num_compte = $request->input('num_compte');
        $client->save();

        $user = new User();
        $user->name = $request->input('nom')." ".$request->input('prenom');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = 0;
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
        $client = Client::findOrFail($id);
        return view('clients.show', ['client'=>$client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', ['client'=>$client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
		$client->nom = $request->input('nom');
		$client->prenom = $request->input('prenom');
		$client->adresse = $request->input('adresse');
		$client->email = $request->input('email');
		$client->tel = $request->input('tel');
		$client->date_naissance = $request->input('date_naissance');
		$client->num_compte = $request->input('num_compte');
        $client->save();

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index');
    }
}
