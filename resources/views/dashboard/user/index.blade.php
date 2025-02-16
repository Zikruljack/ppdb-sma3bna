@extends('adminlte::page')
@section('title', 'Users')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
                        </div>
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
