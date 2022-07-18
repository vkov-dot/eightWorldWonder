<?php

namespace App\Http\Controllers;

use App\Services\RatingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    private $service;

    public function __construct(RatingService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->service->store($request);

        return response()->json(['message' => 'success']);
    }
}
