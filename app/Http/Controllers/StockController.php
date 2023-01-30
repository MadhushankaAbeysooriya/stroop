<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\Models\Establishment;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:stock-list|stock-create|stock-edit|stock-delete', ['only' => ['index', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StockDataTable $dataTable)
    {
        return $dataTable->render('stock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $establishment = Establishment::find($stock->item->establishment_id);
        return view('stock.show', compact('stock','establishment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
