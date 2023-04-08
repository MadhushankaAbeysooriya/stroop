<?php

namespace App\Http\Controllers;

use is;
use App\Models\Item;
use App\Models\Title;
use App\Models\ItemUnit;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ajaxController extends Controller
{
    public function getTitle(request $request)
    {
        if ($request->ajax()) {
            return Title::where('store_id', $request->store_id)->get();
        } else {
            return Title::all();
        }
    }

    public function getItemCode(request $request)
    {
        if ($request->ajax()) {
            return Item::where('store_id', $request->store_id)->where('title_no', $request->title_no)->where('ict', $request->ict)->where('category_type', $request->category_type)->get();
        }
    }

    public function getItemSerial($id)
    {
        $item = Item::findOrFail($id);
        return response()->json([
            'is_serial' => $item->is_serial,
            'is_unit' => $item->is_unit
        ]);
    }

    public function getItemUnits($id)
    {
        //dd($id);
        $itemunits = ItemUnit::with('sub_item')->where('item_id',$id)->get();
        //dd(count($itemunits));

        return response()->json([
            'itemunits' => $itemunits
        ]);
    }

    // public function getUnit($id)
    // {
    //     $item = Item::findOrFail($id);
    //     return response()->json([
    //         'is_unit' => $item->is_unit
    //     ]);
    // }

}
