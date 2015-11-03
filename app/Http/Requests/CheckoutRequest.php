<?php

namespace CodeDelivery\Http\Requests;

class CheckoutRequest extends Request
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
            //consulta na tabela de cupoms se o "cupom code" existe com o campo code, e se o used=0, ou seja, não foi usado
            'cupom_code' => 'exists:cupoms,code,used,0',
        ];
    }
}
