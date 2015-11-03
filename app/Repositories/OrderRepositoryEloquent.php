<?php

namespace CodeDelivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Order;

/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getByIdAndDeliveryman($order_id, $deliveyman_id)
    {

        $result = $this->with(['client', 'itens', 'cupom'])->findWhere([
            'id' => $order_id,
            'user_deliveryman_id' => $deliveyman_id
        ]);

        $result = $result->first();

        if ($result) {
            $result->itens->each(function ($item) {
                $item->product;
            });
        }
        return $result;
    }
}
