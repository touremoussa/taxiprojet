<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
         return
         [
	// 		'client_id' => 'required',
	// 		'chauffeur_id' => 'required',
	// 		'dure' => 'required',
	// 		'adresse_depart' => 'required',
	// 		'adresse_arrivee' => 'required',
	// 		'd_longitude' => 'required',
	// 		'd_latitude' => 'required',
	// 		'a_longitude' => 'required',
	// 		'a_latitude' => 'required',
	// 		'prix' => 'required',
	// 		'etat' => 'required',
         ];
    }
}
