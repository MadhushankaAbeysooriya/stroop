<?php

namespace App\Http\Controllers;

use App\DataTables\ReceiveDataTable;
use App\Http\Requests\ReceiveRequest;
use App\Models\Equipment;
use App\Models\ICTCategory;
use App\Models\Purchase;
use App\Models\Receive;
use App\Models\RecivePlace;
use App\Models\SerNo;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Title;
use App\Models\ItemSubRelation;
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
        $recivePlace = RecivePlace::all();
        return view('receive.create', compact('stores', 'icts', 'equipments', 'titles', 'purchase', 'recivePlace'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReceiveRequest $request)
    {
        //dd($request);       
        
        $recive = Receive::create(['Item_Auto_Id' => $request->Item_Auto_Id, 
        'quentity' => $request->quentity, 
        'Issu_date' => $request->Issu_date, 
        'Issu_remarks' => $request->Issu_remarks, 
        'Issued_place_id' => 1,
            'ent_date' => Carbon::now(), 
            'ent_user_id' => Auth::user()->id, 
            'Voucher_No' => $request->Voucher_No, 
            'rec_from' => $request->rec_from, 
            'warranty' => $request->warranty,
            'duration' => $request->duration, 
            'price' => $request->price, 
            'warranty_act_date' => $request->warranty_act_date, 
            'Issued_Type' => 0, 'fcolor' => 'red',
            'estb_id' => Auth()->user()->estb_id,
        ]);

        $stock = Stock::where('item_id', $request->Item_Auto_Id);
                        //->where('estb_id',Auth()->user()->estb_id);
        if(count($stock) > 0){
            $stock->update([
                //'item_id' => $request->Item_Auto_Id, 
                'qty' => $stock->first()->qty + $request->quentity, 
                'last_txn_type' => 'in'
            ]);
        }else{
            Stock::create([
                'item_id' => $request->Item_Auto_Id,
                'qty' => $request->quentity, 
                'last_txn_type' => 'in',
                //'estb_id' => Auth()->user()->estb_id,
            ]);
        }
            

        if (!empty(request('addmore')[0]['ser'])) {
            //dd($request);
            foreach ($request->addmore as $ser) {
                SerNo::create([
                    'Item_Auto_Id' => $request->Item_Auto_Id, 
                    'stk_Auto_Id' => $recive->id, 
                    'Seri_No' => $ser['ser'], 
                    'name' => $ser['name'], 
                    'estb_id' => Auth()->user()->estb_id
                ]);
            }
        }

        if (!empty(request('addmore')[0][0]['ser'])) {            
            foreach ($request->addmore as $ser) {
                $parent_id = null;                
                foreach($ser as $i){
                    //dd($i);
                    $ser_create = SerNo::create([
                        'Item_Auto_Id' => $request->Item_Auto_Id, 
                        'stk_Auto_Id' => $recive->id, 
                        'Seri_No' => $i['ser'], 
                        'name' => $i['name'], 
                        'estb_id' => Auth()->user()->estb_id
                    ]);

                    // set parent_id for the first iteration
                    if (!$parent_id) {
                        $parent_id = $ser_create->id;
                    }

                    ItemSubRelation::create([
                        'ser_no'=>$ser_create->id,
                        'parent'=>$parent_id,
                    ]);
                }                
            }
        }

        return redirect()->route('receive.index')
            ->with('message', 'Receive created successfully.');
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
