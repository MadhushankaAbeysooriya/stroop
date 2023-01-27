<?php

namespace App\Http\Controllers;

use App\DataTables\ItemsDataTable;
use App\Http\Requests\ItemRequest;
use App\Models\Equipment;
use App\Models\ICTCategory;
use App\Models\Item;
use App\Models\MesureUnit;
use App\Models\Store;
use App\Models\Title;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:item-list|item-create|item-edit|item-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:item-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:item-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemsDataTable $dataTable)
    {
        return $dataTable->render('item.index');
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
        $mesures = MesureUnit::all();
        return view('item.create', compact('stores', 'icts', 'equipments', 'titles', 'mesures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ItemRequest $request)
    {
        $itemData = $request->all();
        if ($request->category_type == 1) {
            $itemData['is_spare'] = 1;
        }

        $latestCode = $this->GetNextItemCode($request->store_id, $request->title_no);
        $tpcode = Equipment::find($request->category_type);

        if (!isset($latestCode->Item_Code)) {

            if (strlen($request->title_no) == 1) {
                $newmain_title = "00" . $request->title_no;
            } else if (strlen($request->title_no) == 2) {
                $newmain_title = "0" . $request->title_no;
            } else {
                $newmain_title = $request->title_no;
            }
            $newcode = '8' . $request->store_id . $request->ict . $tpcode->Type_Code . $newmain_title . '001';
        } else {

            $lasttwo = substr($latestCode->Item_Code, -3) + 1;    //this is last 3
            if (strlen($lasttwo) == 1) {
                $lasttwo = '00' . $lasttwo;
            } else if (strlen($lasttwo) == 2) {
                $lasttwo = '0' . $lasttwo;
            }
            $firsttwo = substr($latestCode->Item_Code, 0, 2);   //get first two

            $gettitle = substr($latestCode->Item_Code, 4, 3);   // get title

            $firstseven = $firsttwo . $request->ict . $tpcode->Type_Code . $gettitle;

            $newcode = $firstseven . $lasttwo;
        }

        $itemData['Item_Code'] = $newcode;

        Item::create($itemData);

        return redirect()->route('item.index')
            ->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Item $item)
    {
        $stores = Store::all();
        $icts = ICTCategory::all();
        $equipments = Equipment::all();
        $titles = Title::all();
        $mesures = MesureUnit::all();

        return view('item.edit', compact('item', 'stores', 'icts', 'equipments', 'titles', 'mesures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ItemRequest $request, Item $item)
    {
        $itemData = $request->all();
        if ($request->category_type == 1) {
            $itemData['is_spare'] = 1;
        }
        $itemData['Item_Code'] = $item->Item_Code;

        $item->update($itemData);

        return redirect()->route('item.index')
            ->with('message', 'Item update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')
            ->with('message', 'Item deleted successfully');
    }

    function GetNextItemCode($store_id, $title_no)
    {
        return Item::where('store_id', $store_id)->where('title_no', $title_no)->latest()->first();
    }

}
