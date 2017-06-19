<?php

namespace GaziWorks\Performance\Http\Requests;

class CreateOverheadRequest extends Request
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
            'name'              => 'required',
            'overhead_group_id' => 'required',
            'type'              => 'required|in:variable,fixed,provision',
        ];
    }
}
