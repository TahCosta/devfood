<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
	use HasApiTokens, HasFactory;

	protected $fillable = [
		'name',
		'email',
		'password',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	public function orders(): HasMany
	{
		return $this->hasMany(Order::class);
	}

	public function evaluations(): HasMany
	{
		return $this->hasMany(Evaluation::class);
	}


}
