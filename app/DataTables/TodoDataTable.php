<?php

namespace App\DataTables;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TodoDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row){
                $actionBtn = '
                <form action="'.route("todos.destroy", $row->id).'" method="POST">
                <a href="'.route("todos.edit", $row->id).'" class="edit btn btn-info btn-sm">Edit</a>
                <a href="todos/show/'.$row->id.'" class="edit btn btn-success btn-sm">View</a>
                '.csrf_field().'
                '.method_field("DELETE").'
                <button class="delete btn btn-danger btn-sm">Delete</button>
                </form>
                ';
                return $actionBtn;
            } )
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Todo $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('todo-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                    ->title('No')
                  ->exportable(false)
                  ->printable(false)
                  ->width(50)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('title'),
            Column::make('description'),
            Column::make('priority'),
            Column::make('due_date')->width(120),
            Column::make('is_completed'),
            //Column::make('created_at'),
            //Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Todo_' . date('YmdHis');
    }
}
