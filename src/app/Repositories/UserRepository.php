<?php

namespace App\Repositories;

use App\Models\User;

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

    public function getByEmail($email)
    {
        return $this->query()
            ->where('email', $email)
            ->first();
    }
}
