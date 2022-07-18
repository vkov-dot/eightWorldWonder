<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update($request)
    {
        $user = $this->find($request->id);
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->admin = $request->admin;
        $user->email = $request->email;
        $user->name = $request->name;

        $user->update();
    }

    public function getByEmail($email)
    {
        return $this->repository->getByEmail($email);
    }
}
