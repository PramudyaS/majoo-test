<?php

namespace Domain\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => ['required','unique:products'],
            'product_category_id'   => ['required','exists:product_categories,id'],
            'price'                 => ['required','integer','min:0'],
            'description'           => ['required'],
            'images_id'             => ['required']
        ];
    }
}
