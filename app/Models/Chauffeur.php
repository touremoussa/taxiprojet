<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    use HasFactory;

	public function vehicule()
	{
		return $this->hasOne('App\Models\Vehicule');
	}

	public function reservations()
	{
		return $this->belongsToMany('App\Models\Reservation');
	}
}
