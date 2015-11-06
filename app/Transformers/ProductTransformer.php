<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\Product;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderItemTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'         => (int) $model->name,
            'price'         => (int) $model->price,
        ];
    }
}
