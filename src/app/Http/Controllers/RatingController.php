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
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('states.show', ['state' => $request->state_id]);
    }
}
