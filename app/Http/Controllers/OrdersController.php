<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminOrderRequest;
use CodeDelivery\Repositories\CategoryRepository;
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
     * @param CategoryRepository|OrderRepository|ProductRepository $repository
     * @param OrderItemRepository $repository_items
     * @param ProductRepository $repository_product
     * @param UserRepository $repository_user
     * @internal param CategoryRepository $repository_category
     */
    public function __construct(OrderRepository $repository, OrderItemRepository $repository_items,
                                ProductRepository $repository_product, UserRepository $repository_user)
    {

        $this->repository = $repository;
        $this->repository_product = $repository_product;
        $this->repository_user = $repository_user;
        $this->repository_items = $repository_items;
    }

    public function index()
    {
        #$categories = $this->repository->all();
        $orders = $this->repository->with('deliveryman', 'client')->all();

        #dd($orders);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->repository->find($id);
        $products = $this->repository_items->with('product')->findWhere(['order_id'=>$id]);
        $client = $this->repository_user->with('client')->findWhere(['client_id'=>$order->client_id]);
        $deliveryman = $this->repository_user->find($order->deliveryman_id);


        dd($products);


        return view('admin.orders.edit', compact('order', 'deliverymen'));
    }

    public function edit($id)
    {
        $order = $this->repository->find($id);
        $deliverymen = $this->repository_user->lists();

        return view('admin.orders.edit', compact('order', 'deliverymen'));
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

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.orders.index');
    }
}