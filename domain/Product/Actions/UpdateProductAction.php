<?php

namespace Domain\Product\Actions;

use Domain\Product\Models\Product;
use Illuminate\Http\Request;

class UpdateProductAction
{
    public function execute(Request $request,int $id) : Product
    {
        $product = Product::find($id);
        $product->name                  = $request->name;
        $product->product_category_id   = $request->product_category_id;
        $product->price                 = $request->price;
        $product->description           = $request->description;
        $product->images_id             = $request->images_id ?? $product->images_id;
        $product->update();

        return $product;
    }
}
