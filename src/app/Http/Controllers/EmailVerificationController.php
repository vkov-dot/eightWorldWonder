<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Jobs\VerificationJob;
use App\Models\User;
use App\Services\EmailVerificationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class EmailVerificationController extends RegisterController
{
    private $service;

    public function __construct(EmailVerificationService $service)
    {
        $this->service = $service;
    }

    public function verify(Request $request, UserService $userService)
    {
        $this->service->verify($request);
        $user = $userService->getByEmail($request->email);

        return view('auth.verify', ['userId' => $user->id]);
    }

    public function activate(Request $request)
    {
        $this->service->activate($request);

        return $this->reset($request);
    }

    public function reset(Request $request)
    {
        $this->service->reset($request);

        return view('auth.verify', ['userId' => $request->id]);
    }
}
