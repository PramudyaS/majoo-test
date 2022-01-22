<?php

namespace App\Http\Controllers\API\ProductCategory;

use App\Http\Controllers\Controller;
use Domain\ProductCategory\Models\ProductCategory;
use Illuminate\Http\Request;

class GetProductCategory extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $id)
    {
        $category = ProductCategory::findorFail($id);

        return response()->json([
            'message'   => 'Success show category',
            'data'      => $category
        ]);
    }
}
