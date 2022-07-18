<?php

namespace App\Services;

use App\Models\Rating;

class RatingService extends BaseService
{
    private function query()
    {
        return Rating::query();
    }

    public function store($request)
    {
        $user = auth()->id();
        $rating = $this->query()->where('user_id', $user)->get();
        $data = [
            'user_id' => $user,
            'state_id' => $request->state_id,
            'rating' => $request->rating,
        ];
        if($rating->count()) {
            $this->query()->where('user_id', $user)->update($data);
        }
        else {
            $this->query()->create($data);
        }
    }
}
