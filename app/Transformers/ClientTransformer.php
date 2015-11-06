<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Client;

/**
 * Class ClientTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

    /**
     * Transform the \Client entity
     * @param \Client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'         => (int) $model->user->name,
            'email'         => (int) $model->user->email,
            'phone'         => (int) $model->address,
            'address'         => (int) $model->address,
            'zipcode'         => (int) $model->zipcode,
            'city'         => (int) $model->city,
            'state'         => (int) $model->state,
        ];
    }
}
