<?php

namespace CodeDelivery\Http\Requests;

use Illuminate\Http\Request as HttpRequest;

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
     * @param HttpRequest $request
     * @return array
     */
    public function rules(HttpRequest $request)
    {
        $rules = [
            //consulta na tabela de cupoms se o "cupom code" existe com o campo code, e se o used=0, ou seja, não foi usado
            'cupom_code' => 'exists:cupoms,code,used,0',
            //
        ];
        $this->buildRulesitems(0, $rules);
        //obtem os items do submit e caso tenha passado algum valor null, ele substitui por um array vazio
        $items = $request->get('items', []);
        //validacao 2: se não for array transforma em array, e se já for, insere os valores na posição
        $items = !is_array($items) ? [] : $items;

        foreach($items as $key => $val){
            $this->buildRulesitems($key, $rules);
        }
        return $rules;
    }

    public function buildRulesitems($key, array &$rules)
    {
        $rules['items.'.$key.'.product_id'] = 'required';
        $rules['items.'.$key.'.qtd'] = 'required';
    }
}
