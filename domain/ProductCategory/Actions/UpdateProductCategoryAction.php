<?php

namespace Domain\ProductCategory\Actions;

use Domain\ProductCategory\Models\ProductCategory;
use Illuminate\Http\Request;

class UpdateProductCategoryAction
{
    public function execute(Request $request,$id) :ProductCategory
    {
        $category = ProductCategory::find($id);
        $category->name = $request->name;
        $category->save();

        return $category;
    }
}
