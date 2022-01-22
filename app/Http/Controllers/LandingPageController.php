<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Domain\Product\QueryBuilders\ProductMasterQuery;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $products           = Product::query()
            ->with('product_category')
            ->with('image')
            ->paginate(5);

        return view('landing_page',[
            'products'   => $products
        ]);
    }
}
