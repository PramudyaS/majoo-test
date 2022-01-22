<?php

namespace Domain\ProductCategory\Actions;

use Domain\ProductCategory\Models\ProductCategory;
use Illuminate\Http\Request;

class CreateProductCategoryAction
{
    public function execute(Request $request) : ProductCategory
    {
        $category = new ProductCategory();
        $category->name = $request->name;
        $category->save();

        return $category;
    }
}
