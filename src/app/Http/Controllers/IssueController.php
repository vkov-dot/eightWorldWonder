<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Models\Category;
use App\Models\Heading;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Issue::select('id', 'name', 'link')->where('archived', 0)->orderBy('id', 'desc')->paginate(20);

        return view('issues.index', ['issues' => $issues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('issues.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IssueRequest $request)
    {
        $data = $request->except('_token');
        Issue::create($data);

        return redirect()->route('issues.index');
    }

    public function search(IssueRequest $request)
    {
        $issues = Issue::where('name', 'LIKE', "%$request->param%")->where('archived', 1)->get();

        return view('issues.index', ['issues' => $issues]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $issue = Issue::find($id);
        $headings = Heading::all();

        return view('issues.edit', [
            'issue' => $issue,
            'headings' => $headings
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(IssueRequest $request, $id)
    {
        $data = $request->except('_token', '_method');
        $issue = Issue::find($id);
        $issue->update($data);

        return redirect()->route('issues.show', ['issue' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $issue = Issue::find($id);
        if($issue['archived']) {
            $issue->delete();
        }
        else {
            $issue['archived'] = 1;
        }
        $issue->update();

        return redirect()->route('issues.index');
    }

    public function recover($id)
    {
        $issue = Issue::find($id);
        $issue->archived = 0;
        $issue->update();

        return redirect()->route('archives.show', ['table' => 'issues']);
    }
}
