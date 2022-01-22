<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Controllers\Controller;
use Domain\ProductCategory\Actions\CreateProductCategoryAction;
use Domain\ProductCategory\Actions\DeleteProductCategoryAction;
use Domain\ProductCategory\Actions\UpdateProductCategoryAction;
use Domain\ProductCategory\Models\ProductCategory;
use Domain\ProductCategory\Requests\ProductCategoryRequest;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(?Request $request = null)
    {
        $product_category = ProductCategory::paginate(5);

        return view('modules.product_category.index',[
            'product_category'  => $product_category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request,CreateProductCategoryAction $action)
    {
        $action->execute($request);

        return back()->withMessage('Success Create New Data');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, $id,UpdateProductCategoryAction $action)
    {
        $action->execute($request,$id);

        return back()->withMessage('Success Update Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,DeleteProductCategoryAction $action)
    {
        $action->execute($id);

        return back()->withMessage('Succes Delete Data');
    }
}
