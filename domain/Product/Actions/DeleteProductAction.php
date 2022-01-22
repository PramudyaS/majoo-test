<?php

namespace Domain\Product\Actions;

use Domain\Images\Actions\DeleteImageAction;
use Domain\Product\Models\Product;

class DeleteProductAction
{
    public function execute(int $id)
    {
        $product = Product::findOrFail($id);
        (new DeleteImageAction())->execute($product->images_id);
        $product->delete();
    }
}
