<?php

namespace App\DataTables;

use App\Models\PenilaianKelulusan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PenilaianKelulusanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'penilaiankelulusan.action')
            ->addColumn('jenis_kelamin', function ($row) {
                return $row->jenis_kelamin == 'Laki-laki' ? 'L' : 'P';
            })
            ->addColumn('total_nilai', function ($row) {
                return $row->nilai_rapor + $row->nilai_sertifikat;
            })
            ->addColumn('nama_lengkap', function ($row) {
                return ucfirst($row->nama_lengkap);
            })
            ->addColumn('asal_sekolah', function ($row) {
                return ucfirst($row->asal_sekolah);
            })
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PenilaianKelulusan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('penilaiankelulusan-table')
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
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('nisn'),
            Column::make('nama_lengkap')->title('Nama Peserta'),
            Column::make('jenis_kelamin')->title('Jenis Kelamin'),
            Column::make('asal_sekolah')->title('Asal Sekolah'),
            Column::make('nilai_rapor')->title('Nilai Rapor'),
            Column::make('nilai_sertifikat')->title('Nilai Sertifikat'),
            Column::make('total_nilai')->title('Total Nilai'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PenilaianKelulusan_' . date('YmdHis');
    }
}
