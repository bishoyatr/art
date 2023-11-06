<?php
namespace App\Services;

use App\Models\Category;

class CategoryService
{

    private Category $car;

    public function __construct()
    {
        $this->category = new Category();
    }
    public function mainCategories()
    {
       return $this->category::whereNull('parent_id')->where('is_active',1)->get();
    }

    // Add other methods related to categories here
}
