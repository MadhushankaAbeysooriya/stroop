<?php

namespace App\Http\Controllers;

use App\DataTables\TitleDataTable;
use App\Http\Requests\TitleRequest;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TitleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:title-list|title-create|title-edit|title-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:title-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:title-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:title-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TitleDataTable $dataTable)
    {
        return $dataTable->render('title.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $stores = Store::all();
        return view('title.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TitleRequest $request)
    {

        Title::create(['title_no' => 1, 'title_name' => $request->title_name, 'store_id' => $request->store_id,
            'create_date' => Carbon::now(), 'user_id' => Auth::user()->id]);
        return redirect()->route('title.index')
            ->with('message', 'Title created successfully.');
    }

    /**
     * /**
     * Display the specified resource.
     *
     * @param \App\Models\Title $title
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Title $title)
    {
        return view('title.show', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Title $title
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Title $title)
    {
        $stores = Store::all();
        return view('title.edit', compact('title', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Title $title
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(TitleRequest $request, Title $title)
    {
        $title->update(['title_no' => 1, 'title_name' => $request->title_name, 'store_id' => $request->store_id,
            'modified_date' => Carbon::now(), 'modified_user_id' => Auth::user()->id]);
        return redirect()->route('title.index')
            ->with('message', 'Title update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Title $title
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Title $title)
    {
        $title->update(['active' => $title->active == 1 ? 0 : 1]);
        return redirect()->route('title.index')
            ->with('message', 'Title status successfully');
    }
}
