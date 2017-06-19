<?php

namespace GaziWorks\Performance\Http\Requests;

use GaziWorks\Performance\Http\Requests\Request;

class ShowPriceChartRequest extends Request
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
            'month' => 'required',
            'year'  => 'required'
        ];
    }
}
