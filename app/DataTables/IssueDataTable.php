<?php

namespace App\DataTables;

use App\Models\Receive;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IssueDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($item) {
                return '<div class="w-80"></div><a href="' . route('issue.show', $item->id) . '" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Receive Details"><i class="fa fa-eye"></i></a>
                </div>';
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Receive $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Receive $model)
    {
        return $model->newQuery()->with(['items'])->select('m_issue_stock.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('m_issue_stock-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderable(false),
            Column::make('items.Item_Code')->title("Item Code"),
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
        return 'm_issue_stock_' . date('YmdHis');
    }
}
