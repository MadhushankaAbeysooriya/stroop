<?php

namespace App\Http\Controllers;

use App\DataTables\PurchaseDataTable;
use App\Http\Requests\PurchaseRequest;
use App\Models\Establishment;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PurchaseController extends Controller
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
    public function index(PurchaseDataTable $dataTable)
    {
        return $dataTable->render('purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $suplier = Supplier::all();
        $establisments = Establishment::all();
        $votes = Vote::all();

        return view('purchase.create', compact('suplier', 'establisments','votes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PurchaseRequest $request)
    {
        Purchase::create(['purchase_order_no' => $request->purchase_order_no, 'sup_id' => $request->sup_id, 'vote_id' => $request->vote_id, 'rcvd_to' => $request->rcvd_to, 'amount' => $request->amount,
            'p_order_remarks' => $request->p_order_remarks, 'user_id' => Auth::user()->id, 'create_date' => Carbon::now(), 'is_active' => empty($request->is_active) ? 0 : $request->is_active]);
        return redirect()->route('supplier.index')
            ->with('message', 'Purchase Order created successfully.');
    }

    /**
     * /**
     * Display the specified resource.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Purchase $purchase)
    {
        return view('purchase.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Purchase $purchase)
    {
        return view('purchase.edit', compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(PurchaseRequest $request, Purchase $purchase)
    {

        $purchase->update(['purchase_order_no' => $request->purchase_order_no, 'sup_id' => $request->sup_id, 'vote_id' => $request->vote_id, 'rcvd_to' => $request->rcvd_to, 'amount' => $request->amount,
            'p_order_remarks' => $request->p_order_remarks, 'user_id' => Auth::user()->id, 'is_active' => empty($request->is_active) ? 0 : $request->is_active]);
        return redirect()->route('purchase.index')
            ->with('message', 'Purchase Order update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Purchase $purchase)
    {
        $purchase->update(['active' => $purchase->active == 1 ? 0 : 1]);
        return redirect()->route('purchase.index')
            ->with('message', 'Purchase Order status successfully');
    }
}
