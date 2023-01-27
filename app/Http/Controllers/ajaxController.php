<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Title;
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

}
