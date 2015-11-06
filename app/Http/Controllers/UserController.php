<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminOrderRequest;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\UserRepository;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authenticated()
    {
        $userId = Authorizer::getResourceOwnerId();
        $rtrn = $this->repository->find($userId);

        return $rtrn;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function show()
    {
    }
}