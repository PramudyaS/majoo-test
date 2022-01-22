<?php

namespace Domain\Product\Models;

use Domain\Images\Models\TemporaryUploadImage;
use Domain\ProductCategory\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function image()
    {
        return $this->belongsTo(TemporaryUploadImage::class);
    }
}
