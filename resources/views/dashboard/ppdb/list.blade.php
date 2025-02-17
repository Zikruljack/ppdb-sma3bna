@extends('adminlte::page')

@section('title', 'List Peserta')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Peserta</h3>
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table(['class' => 'table w-100']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
