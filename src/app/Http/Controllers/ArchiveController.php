<?php

namespace App\Http\Controllers;

use App\Services\ArchiveService;
use App\Services\IssueService;
use App\Services\StateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArchiveController extends Controller
{
    private $service;

    public function __construct(ArchiveService $service)
    {
        $this->service = $service;
    }

    /**
     * Display the specified resource.
     *
     * @param $tableName
     * @return Application|Factory|View
     */
    public function show($tableName)
    {
        $table = $this->service->show($tableName);

        return view('archived.show', [
            'table' => $table,
            'name' => $tableName
        ]);
    }
}
