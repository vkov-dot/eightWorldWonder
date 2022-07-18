<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function edit()
    {
        return $this->service->getProfile();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->service->update($request);

        return response()->json(['message' => 'success']);
    }
}
