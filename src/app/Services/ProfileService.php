<?php

namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    private $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show()
    {
        return auth()->user();
    }

    public function edit()
    {
        return auth()->user();
    }

    public function update($request)
    {
        $user = $this->repository->find($request->user);
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->admin = auth()->user()->admin;
        $user->email = $request->email;
        $user->name = $request->name;

        $user->update();
    }
}
