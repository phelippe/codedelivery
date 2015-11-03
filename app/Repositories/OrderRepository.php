<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderRepository
 * @package namespace CodeDelivery\Repositories;
 */
interface OrderRepository extends RepositoryInterface
{

    public function getByIdAndDeliveryman($order_id, $deliveyman_id);
}
