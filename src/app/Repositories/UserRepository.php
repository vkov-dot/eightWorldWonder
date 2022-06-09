<?php

namespace App\Repositories;

use App\Models\User;
use http\Client\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function query()
    {
        return User::query();
    }

    public function index()
    {
        return $this->query()
            ->latest()
            ->paginate(20, ['name', 'id', 'email', 'created_at']);
    }

    public function find(int $id)
    {
        return $this->query()->find($id);
    }

    public function search($request)
    {
        return $this->query()
            ->where($request->message, 'LIKE', "%$request->param%")
            ->latest()
            ->paginate(10, ['name', 'id', 'email', 'created_at']);
    }

    public function edit(int $id)
    {
        return $this->find($id);
    }

    public function update($request, int $id)
    {
        $user = $this->find($id);

        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->admin = $request->role;

        $user->update();
    }
}
