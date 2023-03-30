<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Evaluation;
use App\Http\Requests\EvaluationRequest;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations= Evaluation::all();
        return view('evaluations.index', ['evaluations'=>$evaluations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EvaluationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evaluation = new Evaluation;

		$evaluation->reservation_id = $request->input('res_id');
		$evaluation->note = $request->input('rating');
		$evaluation->commentaire = $request->input('comment');

        $evaluation->save();

        return redirect()->route('client.reservations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        return view('evaluations.show',['evaluation'=>$evaluation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        return view('evaluations.edit',['evaluation'=>$evaluation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EvaluationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EvaluationRequest $request, $id)
    {
        $evaluation = Evaluation::findOrFail($id);
		$evaluation->reservation_id = $request->input('reservation_id');
		$evaluation->note = $request->input('note');
		$evaluation->commentaire = $request->input('commentaire');
        $evaluation->save();

        return redirect()->route('evaluations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();

        return redirect()->route('evaluations.index');
    }
}
