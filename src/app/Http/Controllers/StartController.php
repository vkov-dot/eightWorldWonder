<?php

namespace App\Http\Controllers;

use App\Services\IssueService;
use App\Services\StateService;


class StartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('layouts.app');
    }
}
