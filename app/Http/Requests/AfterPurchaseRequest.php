<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AfterPurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'productId' => 'required|integer',
            'count' => 'required|integer',
            'exchangeTitle' => 'required|string',
        ];
    }
}