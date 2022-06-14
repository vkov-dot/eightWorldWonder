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
}
