<?php

namespace Domain\Product\QueryBuilders;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductMasterQuery
{
    protected $product;
    protected $request;

    public function __construct(?Request  $request = null)
    {
        $builder = Product::query()
        ->with('product_category')
        ->with('image');

        $query = new Builder(clone $builder->getQuery());
        $query->setModel($builder->getModel());

        $this->product = $query;
        $this->request = $request;
    }


    public function paginate()
    {
        $per_page = $this->request->has('per_page') ? $this->request->per_page : 5;
        return $this->product->paginate($per_page);
    }
}
