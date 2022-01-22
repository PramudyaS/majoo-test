<?php

namespace Domain\Product\Actions;

use Domain\Product\Models\Product;
use Illuminate\Http\Request;

class CreateProductAction
{
    public function execute(Request  $request)
    {
        $product = new Product();
        $product->name                  = $request->name;
        $product->product_category_id   = $request->product_category_id;
        $product->price                 = $request->price;
        $product->description           = $request->description;
        $product->images_id             = $request->images_id;
        $product->save();

        return $product;
    }
}
