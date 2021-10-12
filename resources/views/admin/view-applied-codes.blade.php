@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Códigos de los Leones</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@stop


@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="table-codes" width="100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Estatus</th>
                        <th>Sede</th>
                        <th>Total</th>
                        <th>Tipo de uso</th>
                        <th>Fecha de uso</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div type="button" id="modal-add-code" data-toggle="modal" data-target="#modal-code-add" class="btn btn-modal elevation-3 rounded-circle bg-success">
            <i class="fas fa-plus fa-2x"></i>
        </div>
    </div>

    @include('admin.employee.modal-delete', ['form' => 'form-delete-code'])
    @include('admin.codes.modal-form-code', ['title' => 'Add', 'action' => 'add'])
    @include('admin.codes.modal-form-code', ['title' => 'Update', 'action' => 'update'])

@stop

@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('js/ui.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <script src="{{ asset('js/admin-codes.js') }}"></script>
@stop