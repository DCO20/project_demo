<?php

namespace Modules\Suit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuitRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'date' => 'required', 'date_format:m/d/Y',
			'status' => 'required',
			'products.*.category_id' => 'required',
			'products.*.product_id' => 'required',
			'products.*.purveyor_id' => 'required',
			'products.*.price' => 'required',
			'products.*.amount' => 'required', 'min:1'
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
