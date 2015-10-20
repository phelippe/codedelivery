<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Requests\AdminCupomRequest;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\CupomRepository;

class CupomsController extends Controller
{

    private $repository;

    /**
     * @param CupomRepository $repository
     */
    public function __construct(CupomRepository $repository)
    {

        $this->repository = $repository;
    }

    public function index()
    {
        #$cupoms = $this->repository->all();
        $cupoms = $this->repository->paginate();

        return view('admin.cupoms.index', compact('cupoms'));
    }

    public function create()
    {
        return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('admin.cupoms.index');

    }

    public function show($cupom_id)
    {
        $cupom = $this->repository->find($cupom_id);

        return view('admin.cupoms.show', compact('cupom'));
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