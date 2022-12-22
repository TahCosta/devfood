<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
	public function creating(Category $category)
	{
		$category->url = Str::kebab($category->name);
	}

	/**
	 * @param Category $category
	 * @return void
	 */
	public function updating(Category $category)
	{
		$category->url = Str::kebab($category->name);
	}

}
