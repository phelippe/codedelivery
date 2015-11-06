<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\OrderItem;

/**
 * Class OrderItemTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['product'];

    public function transform(OrderItem $model)
    {
        return [
            'id'         => (int) $model->id,
            'price'         => (int) $model->price,
            'qtd'         => (int) $model->qtd,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    //one to many -> orderItem
    public function includeProduct(OrderItem $model)
    {
        return $this->item($model->product, new ProductTransformer());
    }
}
