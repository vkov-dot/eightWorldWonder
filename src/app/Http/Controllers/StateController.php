<?php

namespace App\Http\Controllers;

use App\Models\Heading;
use App\Models\State;
use App\Services\StateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StateController extends Controller
{
    private $service;

    public function __construct(StateService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function index()
    {
        $states = State::orderBy('id', 'desc')->get();

        return view('states.index', ['states' =>$states]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $headings = Heading::all();

        return view('states.create', ['headings' => $headings]);
    }

    /**
     * Store a nuwky created resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->except('_token');
        $data['logo'] = $request->file('logo')->store('images');
        State::create($data);

        return redirect()->route('states.index');
    }


    public function search(Request $request)
    {
        $states = State::where($request->message, 'LIKE', "%$request->param%")->get();

        return view('states.index', ['states' => $states]);
    }

    /**
     * Display the specified resource
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $lastStates = State::orderBy('id', 'desc')->take(10)->get();
        $state = State::find($id);

        return view('states.show', ['state' => $state, 'lastStates' =>$lastStates]);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::find($id);
        $headings = Heading::all();

        return view('states.edit', ['state' => $state, 'headings' => $headings]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $state = State::find($id);
        if($request->logo) {
            Storage::disk('public')->delete($state->logo);
            $data['logo'] = $request->file('logo')->store('images');
        }
        $state->update($data);

        return redirect()->route('states.show', ['state' => $id]);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $state = State::find($id);
        Storage::disk('public')->delete($state->logo);
        $state->delete();

        return redirect()->route('states.index');
    }
}

