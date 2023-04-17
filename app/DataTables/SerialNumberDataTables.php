<?php

namespace App\DataTables;

use App\Models\SerNo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\SerialNumberDataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SerialNumberDataTables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->setRowId('id')
            ->addColumn('estb',function($ser){
                $owner = 'N/A';
                if($ser->estb_id != null){
                    $owner = $ser->estb->place_discription;
                }
                return $owner;
            })
            ->filterColumn('estb', function ($query, $keyword) {
                $query->whereHas('estb', function ($query) use ($keyword) {
                    $query->where('place_discription', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['estb']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SerialNumberDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SerNo $model): QueryBuilder
    {
        return $model->with('estb','items')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('serialnumberdatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderable(false),
            Column::make('Seri_No')->title("S/N"),
            Column::make('estb')->title("owner")->searchable(true)->orderable(true),            
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'SerialNumberDataTables_' . date('YmdHis');
    }
}
