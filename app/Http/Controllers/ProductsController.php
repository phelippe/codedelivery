<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminProductRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Http\Requests;

class ProductsController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $repository_category;

    /**
     * @param CategoryRepository|ProductRepository $repository
     * @param CategoryRepository $repository_category
     */
    public function __construct(ProductRepository $repository, CategoryRepository $repository_category)
    {

        $this->repository = $repository;
        $this->repository_category = $repository_category;
    }

    public function index()
    {
        #$categories = $this->repository->all();
        $products = $this->repository->paginate();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->repository_category->lists();

        return view('admin.products.create', compact('categories') );
    }

    /**
     * @param Requests\AdminCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminProductRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('admin.products.index');

    }

    public function edit($id)
    {
        $product = $this->repository->find($id);
        $categories = $this->repository_category->lists();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(AdminProductRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.products.index');
    }
}