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
        $itemData['Item_Code'] = 'aaa';

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
        $establisments = Establishment::where('active', 1)->get();
        $categories = Category::where('active', 1)->get();

        $parentCategories = null;
        $subCategories = null;
        $childCategories = null;
        $subchildCategories = null;

        $parentid = 0;
        $subCategory = null;
        $childCategory = null;
        $subchildCategory = null;

        $hasCategory = $item->categories()->get();
        $parentCategories = Category::where('parent_id', '=', 0)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->establishment_id : $request->establishment_id)->get();

        if ($hasCategory->count() > 0) {
            $parentid = $parentCategories->intersect($hasCategory)->first()->id;

            if ($parentid !== 0) {
                $subCategories = Category::where('parent_id', '=', $parentid)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->establishment_id : $request->establishment_id)->get();
                $subCategory = $subCategories->intersect($hasCategory)->first();
                if (isset($subCategory)) {
                    $childCategories = Category::where('parent_id', '=', $subCategory->id)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->establishment_id : $request->establishment_id)->get();
                    $childCategory = $childCategories->intersect($hasCategory)->first();
                    if (isset($childCategory)) {
                        $subchildCategories = Category::where('parent_id', '=', $childCategory->id)->where('establishment_id', empty($request->establishment_id) ? Auth::user()->establishment_id : $request->establishment_id)->get();
                        $subchildCategory = $subchildCategories->intersect($hasCategory)->first();
                    }
                }
            }

        }

        $measureUnits = MeasureUnit::where('active', 1)->where('establishment_id', $item->establishment_id)->get();
        return view('item.edit', compact('item', 'categories', 'measureUnits', 'subchildCategories', 'subchildCategory', 'establisments', 'parentCategories', 'subCategories', 'childCategory', 'childCategories', 'parentid', 'subCategory'));
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
//        $request->validate(['name' => 'required|unique:items,name,establishment_id']);

        $request->validate(['name' => ['required', 'max:255', Rule::unique('items')->where(function ($query) use ($item, $request) {
            return $query->where('establishment_id', $request->establishment_id)->where('id', '!=', $item->id);
        })],]);

        $item->update(['name' => $request->name, 'establishment_id' => empty($request->establishment_id) ? Auth::user()->establishment_id : $request->establishment_id, 'code' => $request->code,
            'measure_unit_id' => $request->measure_unit_id, 'latest_user_tbl_id' => Auth::user()->id, 'latest_ip' => $request->ip(), 'active' => empty($request->active) ? 0 : $request->active]);


        $categories = [];
        if (isset($request->category_id)) {
            $categories[] = $request->category_id;
        }
        if (isset($request->parent_id)) {
            $categories[] = $request->parent_id;
        }
        if (isset($request->child_id)) {
            $categories[] = $request->child_id;
        }
        if (isset($request->sub_child_id)) {
            $categories[] = $request->sub_child_id;
        }


        $item->categories()->sync($categories);

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
}
