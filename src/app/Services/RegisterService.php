<?php

namespace App\Services;

use App\Jobs\VerificationJob;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService extends BaseService
{
    public function create(array $data)
    {
        $user = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];
        User::create($user);

        VerificationJob::dispatch($user);
    }
}
