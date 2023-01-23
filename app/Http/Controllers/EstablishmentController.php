<?php

namespace App\Http\Controllers;

use App\DataTables\EstablishmentDataTable;
use App\Http\Requests\EstablishmentRequest;
use App\Models\Establishment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class EstablishmentController extends Controller
{

//    function __construct()
//    {
//        $this->middleware('permission:establishment-list|establishment-create|establishment-edit|establishment-delete', ['only' => ['index', 'store']]);
//        $this->middleware('permission:establishment-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:establishment-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:establishment-delete', ['only' => ['destroy']]);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EstablishmentDataTable $dataTable)
    {
        return $dataTable->render('establishment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('establishment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EstablishmentRequest $request)
    {
        Establishment::create(['issue_place' => $request->issue_place, 'place_discription' => $request->place_discription, 'create_date' => Carbon::now(), 'create_user' => Auth::user()->id]);
        return redirect()->route('establishment.index')
            ->with('message', 'Establishment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Establishment $establishment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Establishment $establishment)
    {
        return view('establishment.show', compact('establishment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Establishment $establishment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Establishment $establishment)
    {
        return view('establishment.edit', compact('establishment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Establishment $establishment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EstablishmentRequest $request, Establishment $establishment)
    {
        $establishment->update(['issue_place' => $request->issue_place, 'place_discription' => $request->place_discription, 'edit_date' => Carbon::now(), 'edit_user' => Auth::user()->id]);
        return redirect()->route('establishment.index')
            ->with('message', 'Establishment update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Establishment $establishment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Establishment $establishment)
    {
        $establishment->update(['active' => $establishment->active == 1 ? 0 : 1]);
        return redirect()->route('establishment.index')
            ->with('message', 'Establishment status successfully');
    }
}
