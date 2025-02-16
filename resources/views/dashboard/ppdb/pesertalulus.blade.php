@extends('adminlte::page')

@section('title', 'Peserta SPMB')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Peserta SPMB divalidasi</h3>
                    </div>
                    <div class="card-body">
                        {!! $dataTable->table(['class' => 'table w-100']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
