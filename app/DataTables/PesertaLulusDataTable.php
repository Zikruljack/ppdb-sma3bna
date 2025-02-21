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
use Illuminate\Support\Facades\DB;

class PesertaLulusDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('aksi', function($row){
                $btn = '<ul class="list-unstyled d-flex gap-2 mb-0">';
                $btn .= '<li><a href="/admin/ppdb/peserta/detail/'.$row->id.'" class="btn btn-sm btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-fw fa-eye"></i></a></li>';
                if($row->status == 'Valid'){
                    $btn .= '<li><a href="/admin/ppdb/peserta/download/kartu/'.$row->id.'" class="btn btn-sm btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Kartu"><i class="fa fa-fw fa-download"></i></a></li>';
                }
                $btn .= '</ul>';
                return $btn;
            })
            ->addIndexColumn()
            ->addColumn('jalur', function($row){
                $jalur = $row->jalur_pendaftaran;
                return $jalur;
            })
            ->addColumn('jenis_kelamin', function ($row) {
                return $row->jenis_kelamin == 'Laki-laki' ? 'L' : 'P';
            })
            ->addColumn('total_nilai', function ($row) {
                return 0;
            })
            ->addColumn('total_nilai', function ($row) {
                $nilaiRapor = $row->bobot_nilai_rapor;
                $nilaiSertifikat = $row->bobot_nilai_sertifikat;
                $niliaWawancara = $row->bobot_nilai_wawancara;
                $nilaiQuran = $row->bobot_nilai_baca_quran;
                $totalNilai = $nilaiRapor + $nilaiSertifikat + $niliaWawancara + $nilaiQuran;
                return number_format($totalNilai, 2, '.', ',') ?? 0;
            })
            ->addColumn('nama_lengkap', function ($row) {
                return ucfirst($row->nama_lengkap) ?? '';
            })
            ->addColumn('asal_sekolah', function ($row) {
                return ucfirst($row->asal_sekolah) ?? '';
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PpdbUser $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('status', 'Valid')
            ->leftJoin('penilaian_peserta', function ($join) {
                $join->on('ppdb_user.user_id', '=', 'penilaian_peserta.user_id')
                    ->whereRaw('penilaian_peserta.bobot_nilai_rapor = (
                        SELECT MAX(bobot_nilai_rapor)
                        FROM penilaian_peserta
                        WHERE penilaian_peserta.user_id = ppdb_user.user_id
                    )');
            })
            ->leftJoin('users', 'ppdb_user.user_id', '=', 'users.id')
            ->select(
                'ppdb_user.id',
                'ppdb_user.nama_lengkap',
                'ppdb_user.nomor_peserta',
                'ppdb_user.jalur_pendaftaran',
                'ppdb_user.status',
                'ppdb_user.asal_sekolah',
                'penilaian_peserta.bobot_nilai_rapor',
                'penilaian_peserta.bobot_nilai_sertifikat',
                'penilaian_peserta.bobot_nilai_wawancara',
                'penilaian_peserta.bobot_nilai_baca_quran',
                'ppdb_user.jenis_kelamin'
            );
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pesertalulus-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
            ->title('No')
            ->searchable(false)
            ->orderable(false),
            Column::make('nomor_peserta')->title('Nomor Peserta'),
            Column::make('nama_lengkap')->title('Nama Lengkap'),
            Column::make('jalur_pendaftaran')->title('Jalur Pendaftaran'),
            Column::make('asal_sekolah')->title('Asal Sekolah'),
            Column::make('bobot_nilai_rapor')->title('Nilai Rapor')->searchable(false),
            Column::make('bobot_nilai_sertifikat')->title('Nilai Sertifikat')->searchable(false),
            Column::make('bobot_nilai_wawancara')->title('Nilai Wawancara')->searchable(false),
            Column::make('bobot_nilai_baca_quran')->title('Nilai Baca Quran')->searchable(false),
            Column::make('total_nilai')->title('Total Nilai')->searchable(false),
            Column::make('status')->title('Status'),
            Column::computed('aksi')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PesertaLulus_' . date('YmdHis');
    }
}
