<?php

namespace App\DataTables;

use App\Models\Receive;
use App\Models\IssueApproveIssue;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class IssueApproveIssueDataTable extends DataTable
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
            ->addColumn('action', 'issueapproveissue.action')
            ->setRowId('id')
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\IssueApproveIssue $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Receive $model)
    {
        return $model->newQuery()->with(['items','issue_place','sig_unit'])
        // 'sig_unit' => function($query) {
        //     $query->where('m_issue_place_id', Auth()->user()->estb_id);
        // }])
        ->where('Is_Issued',1)
        ->where('fwd',0)
        ->join('m_sig_unit', function($join) {
            $join->on('m_issue_stock.issu_sig_unit', '=', 'm_sig_unit.id')
                 ->where('m_sig_unit.m_issue_place_id', Auth()->user()->estb_id);
        })
        //->where('Issued_place_id',Auth()->user()->estb_id)
        // ->where('sig_unit', function($query) {
        //     $query->where('m_issue_place_id', Auth()->user()->estb_id);
        // });
        //->join('m_sig_unit', 'm_issue_stock.issu_sig_unit', '=', 'm_sig_unit.m_issue_place_id')

        // ->join('ownerships',function($join) {
        //     $join->on('machines.id','=','ownerships.machine_id')                    
        //     ->where('ownerships.detach_date','=',null);
        // });
        ->select('m_issue_stock.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('issueapproveissue-table')
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
            Column::make('items.Item_Code')->title("Item Code"),
            Column::make('id')->title("ID"),
            Column::make('items.Item_Type')->title("Item Name"),
            Column::make('quentity')->title("Qty"),
            Column::make('Issu_date')->title("Date"),
            Column::make('price')->title("Price(LKR)"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'IssueApproveIssue_' . date('YmdHis');
    }
}
