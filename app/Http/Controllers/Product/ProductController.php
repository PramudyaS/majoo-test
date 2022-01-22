<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Domain\Product\Actions\CreateProductAction;
use Domain\Product\Actions\DeleteProductAction;
use Domain\Product\Actions\UpdateProductAction;
use Domain\Product\Models\Product;
use Domain\Product\QueryBuilders\ProductMasterQuery;
use Domain\Product\Requests\CreateProductRequest;
use Domain\Product\Requests\UpdateProductRequest;
use Domain\ProductCategory\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request = null)
    {
        $products           = Product::query()
            ->with('product_category')
            ->with('image')
            ->paginate(5);

        return view('modules.product.index',[
            'products'          => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_category   = ProductCategory::all();
        return view('modules.product.create',[
            'product_category'  => $product_category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request, CreateProductAction $action)
    {
        $action->execute($request);

        return redirect()->route('admin.product.index')->withMessage('Success create new product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $product_category   = ProductCategory::all();

        return view('modules.product.edit',[
            'product'           => $product,
            'product_category'  => $product_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id, UpdateProductAction $action)
    {
        $action->execute($request,$id);
        return redirect()->route('admin.product.index')->withMessage('Success update product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,DeleteProductAction $action)
    {
        $action->execute($id);

        return back()->withMessage('Success delete product');
    }
}
