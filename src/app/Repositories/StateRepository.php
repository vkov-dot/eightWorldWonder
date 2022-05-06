<?php

namespace App\Repositories;

use App\Http\Requests\StateEditRequest;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StateRepository
{
    private function query()
    {
        return State::query();
    }

    private function deleteLogo($logo)
    {
        return Storage::disk('public')->delete($logo);
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function create($data)
    {
        return $this->query()->create($data);
    }

    public function getIndex()
    {
        return $this->query()
            ->select('id', 'name', 'author')
            ->where('archived', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    public function getIndexLatest()
    {
        return $this->query()
            ->select('id', 'name', 'author')
            ->where('archived', 0)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
    }

    public function getSearch(Request $request)
    {
        return $this->query()
            ->select('id', 'name', 'author')
            ->where($request->message, 'LIKE', "%$request->param%")
            ->where('archived', 0)
            ->paginate(10);
    }

    public function saveImage($request)
    {
        return $request->file('logo')->store('images');
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $data['logo'] = $request->file('logo')->store('images');

        return $this->query()->create($data);
    }

    public function update(Request $request, int $id)
    {
        $request->except('_token', '_method');
        $data = $this->find($id);
        if($request->logo) {
            $this->deleteLogo($request->logo);
            $data['logo'] = $this->saveImage($request);
        }

        return $data->update();
    }

    public function destroy($id)
    {
        $state = $this->find($id);
        if($state->archived) {
            $this->deletelogo($state->logo);
            $state->delete();
        }
        else {
            $state->archived = 1;
            $state->update();
        }
    }

    public function recover($id)
    {
        $state = $this->find($id);
        $state->archived = 0;
        $state->update();
    }

    public function getForHeading(int $id)
    {
        return $this->query()
            ->where('heading_id', $id)
            ->paginate(10);
    }
}
