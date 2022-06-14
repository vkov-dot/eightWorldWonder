<?php

namespace App\Services;

use App\Repositories\IssueRepository;
use App\Repositories\StateRepository;

class StartService
{
    public function index(StateRepository $stateRepository, IssueRepository $issueRepository)
    {
        $lastNotes['states'] = $stateRepository->getLatest();
        $lastNotes['issues'] = $issueRepository->getLatest();

        return $lastNotes;
    }
}
