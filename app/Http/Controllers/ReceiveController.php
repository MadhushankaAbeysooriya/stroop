<?php

namespace App\Http\Controllers;

use App\DataTables\ReceiveDataTable;
use App\Http\Requests\ReceiveRequest;
use App\Models\Equipment;
use App\Models\ICTCategory;
use App\Models\Purchase;
use App\Models\Receive;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Title;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReceiveController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:receive-list|receive-create|receive-edit|receive-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:receive-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:receive-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:receive-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReceiveDataTable $dataTable)
    {
        return $dataTable->render('receive.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $stores = Store::all();
        $icts = ICTCategory::all();
        $equipments = Equipment::all();
        $titles = Title::all();
        $purchase = Purchase::all();
        return view('receive.create', compact('stores', 'icts', 'equipments', 'titles','purchase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReceiveRequest $request)
    {
        Supplier::create(['Sup_Name' => $request->Sup_Name, 'Addrs' => $request->Addrs, 'Tel' => $request->Tel, 'Fax' => $request->Fax, 'Email' => $request->Email,
            'create_date' => Carbon::now(), 'user_id' => Auth::user()->id]);
        return redirect()->route('supplier.index')
            ->with('message', 'Supplier created successfully.');
    }

    /**
     * /**
     * Display the specified resource.
     *
     * @param \App\Models\Receive $receive
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Receive $receive)
    {
        return view('receive.show', compact('receive'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Receive $receive
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Receive $receive)
    {
        return view('receive.edit', compact('receive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Receive $receive
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(ReceiveRequest $request, Receive $receive)
    {

        $receive->update(['Sup_Name' => $request->Sup_Name, 'Addrs' => $request->Addrs, 'Tel' => $request->Tel, 'Fax' => $request->Fax, 'Email' => $request->Email,
            'edit_date' => Carbon::now(), 'editer_id' => Auth::user()->id]);
        return redirect()->route('receive.index')
            ->with('message', 'Receive update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Receive $receive
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Receive $receive)
    {
        $receive->update(['active' => $receive->active == 1 ? 0 : 1]);
        return redirect()->route('receive.index')
            ->with('message', 'Receive status successfully');
    }
}
