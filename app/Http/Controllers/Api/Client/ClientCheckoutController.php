<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
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

    private $with = ['client', 'cupom', 'items', 'deliveryman'];

    /**
     * @param CategoryRepository|OrderRepository $repository
     * @param UserRepository $userRepository
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
        $clientId = $this->userRepository->find($user_id)->client->id;
        $orders = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function ($query) use ($clientId) {
                return $query->where('client_id', '=', $clientId);
            })->paginate();

        return $orders;
    }

    public function store(Requests\CheckoutRequest $request)
    {
        $data = $request->all();
        $id_client = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id_client)->client->id;
        $data['client_id'] = $clientId;

        $o = $this->service->create($data);

        return $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($o->id);
    }

    public function show($id)
    {
        #$order = $this->repository->with(['items', 'client', 'cupom'])->find($id);

        /*$order->items->each(function($item){
            $item->product;
        });*/#comentado devido a utilização do presenter

        #return $order;

        return $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($id);

    }
}