<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\SerNo;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Title;
use App\Models\Receive;
use App\Models\SigUnit;
use App\Models\Purchase;
use App\Models\Equipment;
use App\Models\ICTCategory;
use App\Models\RecivePlace;
use App\Models\Establishment;
use Illuminate\Support\Carbon;
use App\DataTables\IssueDataTable;
use App\Http\Requests\IssueRequest;
use Illuminate\Support\Facades\Auth;
use App\DataTables\IssueApproveIssueDataTable;
use Illuminate\Http\Request;

class IssueController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:issue-list|receive-create|issue-edit|issue-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:issue-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:issue-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:issue-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IssueDataTable $dataTable)
    {
        //(Auth()->user()->estb_id);
        return $dataTable->render('issue.index');
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
        return view('issue.create', compact('stores', 'icts', 'equipments', 'titles', 'purchase', 'recivePlace', 'issuePlace', 'sigUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IssueRequest $request)
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

        

        $recive = Receive::create(['Item_Auto_Id' => $request->Item_Auto_Id, 'quentity' => $request->quentity, 
            'Issu_date' => $request->issue_date, 'Issued_place_id' => $request->issued_place_id,
            'Issued_Type' => $request->Issued_Type, 'issu_sig_unit' => $request->issu_sig_unit, 
            'Voucher_No' => $request->Voucher_No, 'fcolor' => $fcolor, 'Issu_remarks' => $request->Issu_remarks,
            //'ent_date' => Carbon::now(), 'ent_user_id' => Auth::user()->id, 
            'rec_from' => 1, 
            'warranty' => 0, 'Is_Issued' => 1, 'duration' => 0, 'price' => 0, 'warranty_act_date' => Carbon::now(),
            'estb_id' => Auth()->user()->estb_id, 'job_no' => $request->card_number,
        ]);

        $stock = Stock::where('item_id', $request->Item_Auto_Id);

        $stock->update(['item_id' => $request->Item_Auto_Id, 'qty' => $stock->first()->qty - $request->quentity, 'last_txn_type' => 'out']);

        if (isset($request->addmore)) {
            foreach ($request->addmore as $ser) {
                //dd($ser['ser']); 
                $ser_no = SerNo::where('Seri_No','=',$ser['ser']);
                //dd($ser_no);
                //SerNo::update(['Item_Auto_Id' => $request->Item_Auto_Id, 'stk_Auto_Id' => $recive->id, 'Seri_No' => $ser['ser'], 'name' => $ser['name']]);
                $ser_no->update([
                    'estb_id' => $request->issu_sig_unit, 
                    'Is_Issued' => 1, 
                    'stk_Auto_Id' => $recive->id
                ]);
            }
        }

        return redirect()->route('issue.index')
            ->with('message', 'Issue created successfully.');
    }

    /**
     * /**
     * Display the specified resource.
     *
     * @param \App\Models\Receive $issue
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Receive $issue)
    {
        return view('issue.show', compact('issue'));
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
     * @param \App\Models\Receive $issue
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(IssueRequest $request, Receive $issue)
    {

        $issue->update(['Sup_Name' => $request->Sup_Name, 'Addrs' => $request->Addrs, 'Tel' => $request->Tel, 'Fax' => $request->Fax, 'Email' => $request->Email,
            'edit_date' => Carbon::now(), 'editer_id' => Auth::user()->id]);
        return redirect()->route('issue.index')
            ->with('message', 'Issue update successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Receive $issue
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Receive $issue)
    {
        $issue->update(['active' => $issue->active == 1 ? 0 : 1]);
        return redirect()->route('issue.index')
            ->with('message', 'Issue status successfully');
    }

    public function issue_approve_issue(IssueApproveIssueDataTable $dataTable)
    {
        //(Auth()->user()->estb_id);
        //dd('in');
        return $dataTable->render('issue.fwd');
    }

    public function issue_forward_view(Receive $issue)
    {
        //dd($issue->id);
        $ser_no = SerNo::where('stk_Auto_Id',$issue->id)->get();
        $rank = Rank::all();
        $issuePlace = Establishment::all();   
        return view('issue.fwd_view', compact('issue','ser_no','rank','issuePlace'));
    }

    public function issue_forward(Receive $issue, Request $request)
    {  
        //dd($request);      
        $issue->update([
            'issued_off_no' => $request->issued_off_no,
            'issued_off_rank' => $request->issued_off_rank,
            'issued_off_name' => $request->issued_off_name,
            'issued_off_regiment' => $request->issued_off_regiment,
            'issued_off_remarks' => $request->issued_off_remarks,
            'ent_date' => Carbon::now(), 
            'ent_user_id' => Auth::user()->id,
            'fwd' => 1,
        ]);        

        $ser_no = SerNo::where('stk_Auto_Id','=',$issue->id)->get();

        //dd($ser_no);
        if(count($ser_no) > 0)
        {
            foreach($ser_no as $ser)
            {
                $ser->update([
                    'estb_id' => $issue->Issued_place_id,
                ]);                
            }

        }
        
        return redirect()->route('issue.approve')->with('message', 'Forward Successfully');
    }

    public function issue_return(Receive $issue)
    {  
        //dd($issue->estb_id);      
        $issue->update([
            'rtn' => 1,
        ]);

        $stock = Stock::where('item_id', $issue->Item_Auto_Id);

        $stock->update(['qty' => $stock->first()->qty + $issue->quentity, 'last_txn_type' => 'in']);

        $ser_no = SerNo::where('stk_Auto_Id','=',$issue->id)->get();

        //dd($ser_no);
        if(count($ser_no) > 0)
        {
            foreach($ser_no as $ser)
            {
                $ser->update([
                    'estb_id' => $issue->estb_id,
                ]);                
            }

        }
        
        return redirect()->route('temp.index')->with('message', 'Return Successfully');
    }
}
