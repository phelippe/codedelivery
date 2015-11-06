<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminOrderRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\OrderItemRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\UserRepository;

class OrdersController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $repository;
    /**
     * @var ProductRepository
     */
    private $repository_product;
    /**
     * @var UserRepository
     */
    private $repository_user;
    /**
     * @var OrderItemRepository
     */
    private $repository_items;
    /**
     * @var ClientRepository
     */
    private $repository_client;

    /**
     * @param CategoryRepository|OrderRepository|ProductRepository $repository
     * @param OrderItemRepository $repository_items
     * @param ProductRepository $repository_product
     * @param ClientRepository $repository_client
     * @param UserRepository $repository_user
     * @internal param CategoryRepository $repository_category
     */
    public function __construct(OrderRepository $repository, OrderItemRepository $repository_items,
                                ProductRepository $repository_product, ClientRepository $repository_client,
                                UserRepository $repository_user)
    {

        $this->repository = $repository;
        $this->repository_product = $repository_product;
        $this->repository_user = $repository_user;
        $this->repository_items = $repository_items;
        $this->repository_client = $repository_client;
    }

    public function index()
    {
        #$categories = $this->repository->all();
        $orders = $this->repository->with(['deliveryman', 'client', 'items'])->all();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->repository->find($id);
        $client = $this->repository_user->find($order->client_id);
        $deliveryman = $this->repository_user->find($order->user_deliveryman_id);
        $products = $this->repository_items->with('product')->findWhere(['order_id'=>$id]);

        #dd($deliveryman);

        return view('admin.orders.show', compact('order', 'products', 'client', 'deliveryman'));
    }

    public function edit($id, UserRepository $userRepository)
    {
        $list_status = [
            0=>'Pendente',
            1=>'A caminho',
            2=>'Entregue',
            3=>'Cancelado',
        ];
        $order = $this->repository->with(['client', 'deliveryman', 'items'])->find($id);
        $deliveryman = $userRepository->getDeliverymen();

        #dd($order);
        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    /**
     * @param AdminOrderRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminOrderRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.orders.index');
    }
}