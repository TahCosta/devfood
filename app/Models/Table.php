<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
	use TenantTrait;

	protected $fillable = [
		'identify',
		'description',
		'status',
		'tenant_id',
	];

	public function search($filter = null)
	{
		$results = $this->where('identify', 'LIKE', "%{$filter}%")
			->orWhere('description', 'LIKE', "%{$filter}%")
			->latest()
			->paginate();

		return $results;
	}


}
