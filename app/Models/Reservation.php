<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

	public function client()
	{
		return $this->hasOne('App\Models\Client');
	}

	public function chauffeur()
	{
		return $this->hasOne('App\Models\Chauffeur');
	}

	public function evaluation()
	{
		return $this->hasOne('App\Models\Evaluation');
	}
}
