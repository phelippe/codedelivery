<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{

    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $service;

    private $with = ['client', 'cupom', 'items'];

    /**
     * @param CategoryRepository|OrderRepository $repository
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     * @param OrderService $service
     */
    public function __construct(
        OrderRepository $repository,
        UserRepository $userRepository,
        OrderService $service)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    public function index()
    {
        $user_id = Authorizer::getResourceOwnerId();
        $orders = $this->repository
            ->skipPresenter(false)
            ->with($this->with)->scopeQuery(function ($query) use ($user_id) {
                return $query->where('user_deliveryman_id', '=', $user_id);
            })->paginate();

        return $orders;
    }

    public function show($order_id)
    {
        $user_id = Authorizer::getResourceOwnerId();

        $order = $this->repository
            ->skipPresenter(false)
            ->getByIdAndDeliveryman($order_id, $user_id);

        return $order;
    }

    public function updateStatus(Request $request, $order_id)
    {
        $deliveryman_id = Authorizer::getResourceOwnerId();

        $order = $this->service->updateStatus($order_id, $deliveryman_id, $request->get('status'));
        if ($order) {
            return $this->repository->find($order->id);
        }
        abort(400, 'Order não encontrada');
    }
}