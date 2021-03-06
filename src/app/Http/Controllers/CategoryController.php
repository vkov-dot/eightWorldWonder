<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function show(int $id)
    {
        return $this->service->show($id);
    }
}
