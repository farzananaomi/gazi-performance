<?php

namespace GaziWorks\Performance\Http\Requests;

class CreateProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'                 => 'bail|required|unique:products,code',
            'name'                 => 'required',
            'length'               => 'required',
            'color'                => 'required',
            'recipe_id'            => 'bail|required|exists:recipes,id',
            'product_group_id'     => 'bail|required|exists:product_groups,id',
            'product_sub_group_id' => 'bail|required|exists:product_sub_groups,id',
            'image'                => 'bail|required|image',
        ];
    }
}
