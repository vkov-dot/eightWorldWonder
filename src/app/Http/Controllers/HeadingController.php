<?php

namespace App\Http\Controllers;

use App\Models\Heading;
use App\Models\State;
use Illuminate\Http\Request;

class HeadingController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $headings = Heading::orderBy('id', 'desc')->get();

        return view('headings.index', ['headings' => $headings]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('headings.create');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['image'] = $request->file('image')->store('images');
        Heading::create($data);

        return redirect()->route('headings.index');
    }

    /**
     * Display the specified resource
     *
     * @param int $id
     * @param \Illuminate\Http\Response
     */
    public function show($id)
    {
        $states = State::where('heading_id', $id)->get();
        $heading = Heading::find($id);

        return view('headings.show', [
            'states' => $states,
            'heading' => $heading
        ]);
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
        Heading::find($id)->destroy();
    }
}

