<?php

namespace App\Http\Controllers;

use App\DataTables\VoteDataTable;
use App\Http\Requests\VoteRequest;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VoteController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => ['index', 'store']]);
//        $this->middleware('permission:supplier-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VoteDataTable $dataTable)
    {
        return $dataTable->render('vote.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('vote.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VoteRequest $request)
    {
        Vote::create(['vote_code' => $request->vote_code, 'description' => $request->description]);
        return redirect()->route('vote.index')
            ->with('message', 'Vote created successfully.');
    }

    /**
     * /**
     * Display the specified resource.
     *
     * @param \App\Models\Vote $vote
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Vote $vote)
    {
        return view('vote.show', compact('vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Vote $vote
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Vote $vote)
    {
        return view('vote.edit', compact('vote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Vote $vote
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(VoteRequest $request, Vote $vote)
    {
        $vote->update(['vote_code' => $request->vote_code, 'description' => $request->description]);
        return redirect()->route('vote.index')
            ->with('message', 'Vote update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vote $vote
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Vote $vote)
    {
        $vote->update(['active' => $vote->active == 1 ? 0 : 1]);
        return redirect()->route('vote.index')
            ->with('message', 'Vote status successfully');
    }
}
