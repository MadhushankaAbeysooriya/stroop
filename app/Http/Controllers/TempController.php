<?php

namespace App\Http\Controllers;

use App\DataTables\TempDataTable;
use App\Http\Requests\TempRequest;
use App\Models\Equipment;
use App\Models\Establishment;
use App\Models\ICTCategory;
use App\Models\Purchase;
use App\Models\Receive;
use App\Models\RecivePlace;
use App\Models\SerNo;
use App\Models\SigUnit;
use App\Models\Store;
use App\Models\Title;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TempController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:temp-list|receive-create|temp-edit|temp-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:temp-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:temp-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:temp-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TempDataTable $dataTable)
    {
        return $dataTable->render('temp.index');
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
        $issuePlace = Establishment::all();
        $sigUnit = SigUnit::all();
        return view('temp.create', compact('stores', 'icts', 'equipments', 'titles', 'purchase', 'recivePlace', 'issuePlace', 'sigUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TempRequest $request)
    {

        if ($request->Issued_Type == 'G2') {
            $fcolor = 'blue';
        }

        if ($request->Issued_Type == 'Q5') {
            $fcolor = 'blue';
        }

        if ($request->Issued_Type == 'G4') {
            $fcolor = 'black';
        }

        if ($request->Issued_Type == 'JC') {
            $fcolor = 'yellow';
        }

        $recive = Receive::create(['Item_Auto_Id' => $request->Item_Auto_Id, 'quentity' => $request->quentity, 'Issu_date' => $request->issue_date, 'Issued_place_id' => $request->issued_place_id,
            'Issued_Type' => $request->Issued_Type, 'issu_sig_unit' => $request->issu_sig_unit, 'Voucher_No' => $request->Voucher_No, 'fcolor' => $fcolor, 'Issu_remarks' => $request->Issu_remarks,
            'ent_date' => Carbon::now(), 'ent_user_id' => Auth::user()->id, 'rec_from' => 1, 'warranty' => 0, 'Is_Issued' => 1, 'duration' => 0, 'price' => 0, 'warranty_act_date' => Carbon::now(),
        ]);

        if (isset($request->addmore)) {
            foreach ($request->addmore as $ser) {
                SerNo::create(['Item_Auto_Id' => $request->Item_Auto_Id, 'stk_Auto_Id' => $recive->id, 'Seri_No' => $ser['ser'], 'name' => $ser['name']]);
            }
        }

        return redirect()->route('temp.index')
            ->with('message', 'Temp created successfully.');
    }

    /**
     * /**
     * Display the specified resource.
     *
     * @param \App\Models\Receive $temp
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Receive $temp)
    {
        return view('temp.show', compact('temp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Receive $receive
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Receive $issue)
    {
        return view('issue.edit', compact('issue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Receive $temp
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(TempRequest $request, Receive $temp)
    {

        $temp->update(['Sup_Name' => $request->Sup_Name, 'Addrs' => $request->Addrs, 'Tel' => $request->Tel, 'Fax' => $request->Fax, 'Email' => $request->Email,
            'edit_date' => Carbon::now(), 'editer_id' => Auth::user()->id]);
        return redirect()->route('issue.index')
            ->with('message', 'Temp update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Receive $temp
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Receive $temp)
    {
        $temp->update(['active' => $temp->active == 1 ? 0 : 1]);
        return redirect()->route('temp.index')
            ->with('message', 'Temp status successfully');
    }
}
