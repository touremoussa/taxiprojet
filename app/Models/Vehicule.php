<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

	public function chauffeurs()
	{
		return $this->belongsToMany('App\Models\Chauffeur');
	}
}
