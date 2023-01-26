<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierDataTable;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:supplier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SupplierRequest $request)
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
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(SupplierRequest $request, Supplier $supplier)
    {

        $supplier->update(['Sup_Name' => $request->Sup_Name, 'Addrs' => $request->Addrs, 'Tel' => $request->Tel, 'Fax' => $request->Fax, 'Email' => $request->Email,
            'edit_date' => Carbon::now(), 'editer_id' => Auth::user()->id]);
        return redirect()->route('supplier.index')
            ->with('message', 'Supplier update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Supplier $supplier)
    {
        $supplier->update(['active' => $supplier->active == 1 ? 0 : 1]);
        return redirect()->route('supplier.index')
            ->with('message', 'Supplier status successfully');
    }
}
