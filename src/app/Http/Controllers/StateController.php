<?php

namespace App\Http\Controllers;

use App\Models\Heading;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        //Carbon::parse($states)->isoFormat('d.m.Y');
        return view('states.index', ['states' =>$states] );
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $heading = Heading::all();
        return view('states.create', ['heading' => $heading]);
    }

    /**
     * Store a nuwky created resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        State::create([
            'name' => $request->title,
            'description' => $request->logo,
            'category_id' => $request->body,
            'heading_id' =>$request->heading_id
        ]);

        return redirect()->route('states.index');
    }

    /**
     * Display the specified resource
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = State::findOrFail($id);
        return view('states.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::find($id)->destroy();
    }
}
