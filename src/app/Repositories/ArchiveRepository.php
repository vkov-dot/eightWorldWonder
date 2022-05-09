<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ArchiveRepository
{
    public function show($tableName)
    {
        return DB::table($tableName)
            ->where('archived', 1)
            ->get();
    }

    public function destroy($tableName, $id, StateRepository $stateRepository, IssueRepository $issueRepository)
    {
        if($tableName = 'states') {
            return $stateRepository->destroy($id);
        }

        return $issueRepository->destroy($id);
    }
}
