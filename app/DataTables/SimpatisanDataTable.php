<?php

namespace App\DataTables;

use App\Models\Simpatisan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SimpatisanDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                $actions = '<div class="d-flex justify-content-around">';
                $actions .= '<a href="' . route('simpatisan.show', $row->id) . '" class="btn btn-outline-primary btn-icon">';
                $actions .= '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">';
                $actions .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>';
                $actions .= '<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>';
                $actions .= '<path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>';   
                $actions .= '</svg>';
                $actions .= '</a>';
                $actions .= '<a href="' . route('simpatisan.edit', $row->id) . '" class="btn btn-outline-success btn-icon">';
                $actions .= '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">';
                $actions .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>';
                $actions .= '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>';
                $actions .= '<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>';
                $actions .= '<path d="M16 5l3 3"></path>';
                $actions .= '</svg>';
                $actions .= '</a>';
                $actions .= '<form action="' . route('simpatisan.destroy', $row->id) . '" method="POST">';
                $actions .= csrf_field();
                $actions .= method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-outline-danger btn-icon" onclick="return confirm(\'Apakah Anda yakin ingin menghapus item ini?\')">';
                $actions .= '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">';
                $actions .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>';
                $actions .= '<path d="M4 7l16 0"></path>';
                $actions .= '<path d="M10 11l0 6"></path>';
                $actions .= '<path d="M14 11l0 6"></path>';
                $actions .= '<path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>';
                $actions .= '<path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>';
                $actions .= '</svg>';
                $actions .= '</button>';
                $actions .= '</form>';
                $actions .= '</div>';

                return $actions;
            })
            ->editColumn('regency_id', function ($row) {
                return $row->regency?->name;
            })
            ->editColumn('district_id', function ($row) {
                return $row->district?->name;
            })
            ->editColumn('subdistrict_id', function ($row) {
                return $row->subdistrict?->name;
            })
            ->editColumn('user_id', function ($row) {
                return $row->user?->name;
            })
            ->editColumn('created_at', function ($row) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d F y H:i');
                return $formatedDate;
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Simpatisan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Simpatisan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('simpatisan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('created_at')->searchable(false),
            Column::make('name')->searchable(false)->title('Nama'),
            Column::make('nik')->title('NIK'),
            Column::make('phone')->title('Nomor HP'),
            Column::make('sex')->searchable(false)->title('Jenis Kelamin'),
            Column::make('regency_id')->searchable(false)->title('Kota/Kabupaten'),
            Column::make('district_id')->searchable(false)->title('Kecamatan'),
            Column::make('subdistrict_id')->searchable(false)->title('Kelurahan'),
            Column::make('user_id')->searchable(false)->title('Created By'),
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
        return 'Simpatisan_' . date('YmdHis');
    }
}
