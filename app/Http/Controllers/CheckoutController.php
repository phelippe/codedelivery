<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;

class CheckoutController extends Controller
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
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param CategoryRepository|OrderRepository $repository
     * @param UserRepository $userRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(OrderRepository $repository, UserRepository $userRepository, ProductRepository $productRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    /*public function index()
    {
        #$categories = $this->repository->all();
        $categories = $this->repository->paginate();

        return view('admin.categories.index', compact('categories'));
    }*/

    public function create()
    {
        $products = $this->productRepository->lists();

        return view('customer.order.create');
    }

    /**
     * @param Requests\AdminCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminCategoryRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('admin.categories.index');

    }

    public function edit($id)
    {
        $category = $this->repository->find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(AdminCategoryRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.categories.index');
    }
}