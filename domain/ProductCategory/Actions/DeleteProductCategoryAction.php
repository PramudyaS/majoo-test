<?php

namespace Domain\ProductCategory\Actions;

use Domain\ProductCategory\Models\ProductCategory;

class DeleteProductCategoryAction
{
    public function execute($id) : void
    {
        $category = ProductCategory::find($id);
        $category->delete();
    }
}
