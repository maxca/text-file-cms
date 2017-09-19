<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class RequestAPI extends FormRequest
{
    public function response(array $errors)
    {
        $header = array(
            'code' => '400',
            'message' => 'Bad Request',
        );
        $response = array(
            'header' => $header,
            'transaction_id' => ($this->has('transaction_id')) ? $this->get('transaction_id') : DATE('U'),
            'date_current' => date('Y-m-d H:i:s'),
        );
        $request = $this->all();
        $responseReturn = array_merge($response, $request);
        $responseReturn['data']['message'] = $errors;
        return \Response::json($responseReturn);
    }
}
