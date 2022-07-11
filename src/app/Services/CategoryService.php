<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Carbon\Carbon;

class CategoryService extends BaseService
{
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show($id)
    {
        $category['category'] = $this->repository->getCategory($id);
        $category['issues'] = $this->repository->show($id);
        foreach($category['issues'] as $issue) {
            $issue->published_at = Carbon::parse($issue->created_at)->format('d.m.Y');
        }

        return $category;
    }
}
