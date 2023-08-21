<?php

namespace App\DataTables;

use App\Models\Simpatisan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
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
            ->editColumn('status', function ($row) {
                $allowedEx = ['jpeg','jpg','png','ico','jfif','webp'];
                $fileExtension = pathinfo($row->ktp, PATHINFO_EXTENSION);
                if (in_array(strtolower($fileExtension), $allowedEx) || $row->status == true){
                    $temp = '<a readonly class="disable badge bg-success text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg> Approved</a>';
                    return $temp;
                }
                else{
                    if(!$row->nik){
                        $temp = '<a readonly class="disable badge bg-secondary text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                      </svg> Incomplete data</a>';
                        return $row->status == false?$temp:'';
                    }else{
                        $temp = '<a readonly class="disable badge bg-warning text-nowrap text-decoration-none" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                        </svg> Need Approval</a>';
                        return $row->status == false?$temp:'';
                    }
                }
            })
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
            ->rawColumns(['action','status'])
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
        $query = $model->newQuery();

        if (Auth::user()->hasRole('user')) {
            $query->where('regency_id', '=', Auth::user()->regency_id)->where('district_id','=', Auth::user()->district_id)->where('subdistrict_id', '=', Auth::user()->subdistrict_id);
        }elseif(Auth::user()->hasRole('admin')) {
            $query->where('regency_id', '=', Auth::user()->regency_id);
        }

        return $query;
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
            Column::make('name')->title('Nama'),
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
            Column::make('status')->searchable(false)->title('Status'),
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
