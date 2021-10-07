<?php

namespace Modules\Provider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cnpj' => 'required',
            'corporate_name' => 'required',
            'fantasy_name' => 'required',
            'active' => 'required',
            'note' => 'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
