<?php

namespace App\DataTables;

use App\Models\PpdbUser;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PesertaPPDBDataTable extends DataTable
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
                $btn = '<ul class="list-unstyled d-flex gap-2 mb-0">';
                $btn .= '<li><a href="/admin/ppdb/peserta/detail/'.$row->id.'" class="btn btn-sm btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-fw fa-eye"></i></a></li>';
                $btn .= '<li><a href="/admin/ppdb/peserta/edit/'. $row->id.' " class="btn btn-sm btn-link data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a></li>';
                $btn .= '<li><a href="/admin/ppdb/peserta/validate/'.$row->id.'" class="btn btn-sm btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Validasi"><i class="fa fa-fw fa-check text-success"></i></a></li>';
                if($row->status == 'Valid'){
                    $btn .= '<li><a href="/admin/ppdb/peserta/download/kartu/'.$row->id.'" class="btn btn-sm btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Kartu"><i class="fa fa-fw fa-download"></i></a></li>';
                }
                $btn .= '</ul>';
                return $btn;
            })
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PpdbUser $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pesertappdb-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex') // Kolom penomoran
                ->title('No')
                ->orderable(false)
                ->searchable(false),
            Column::make('nomor_peserta'),
            Column::make('nama_lengkap'),
            Column::make('jalur_pendaftaran'),
            Column::make('status'),
            Column::make('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PesertaPPDB_' . date('YmdHis');
    }
}
