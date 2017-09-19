<?php

namespace App\Http\Requests;

use App\Http\Requests\RequestAPI;

class GenUrlRequest extends RequestAPI
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function boot()
    {
        # code...
    }
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
            'transaction_id' => 'required',
            'msisdn' => '',
            'name' => 'required',
            'sender' => 'required',
        ];
    }
}
