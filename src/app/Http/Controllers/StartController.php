<?php

namespace App\Http\Controllers;

use App\Repositories\IssueRepository;
use App\Repositories\StateRepository;
use App\Services\StartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class StartController extends Controller
{
    private $service;

    public function __construct(StartService $service)
    {
        $this->service = $service;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(StateRepository $stateRepository, IssueRepository $issueRepository)
    {
        $lastNotes = $this->service->index($stateRepository, $issueRepository);

        return view('start', [
            'lastStates' => $lastNotes['states'],
            'lastIssues' => $lastNotes['issues'],
        ]);
    }
}
