<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\UserRepository;

class ClientsController extends Controller
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
     * @var UserRepository
     */
    private $repository_user;

    /**
     * @param CategoryRepository|ClientRepository $repository
     * @param CategoryRepository $repository_category
     */
    public function __construct(ClientRepository $repository, UserRepository $repository_user)
    {

        $this->repository = $repository;
        $this->repository_user = $repository_user;
    }

    public function index()
    {
        $clients = $this->repository->paginate();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        $users = $this->repository_user->lists();

        return view('admin.clients.create', compact('users') );
    }

    /**
     * @param Requests\AdminCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminClientRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('admin.clients.index');

    }

    public function edit($id)
    {
        $client = $this->repository->find($id);
        $users = $this->repository_user->lists();

        return view('admin.clients.edit', compact('client', 'users'));
    }

    public function update(AdminClientRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.clients.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.clients.index');
    }
}