@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@stop


@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-striped" id="table-employees" width="100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Sede</th>
                    <th>Puesto</th>
                    <th>Estatus</th>
                    <th>Código</th>
                    <th>Fecha Ingreso</th>
                    <th>QR</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
    <div type="button" data-toggle="modal" data-target="#modal-employee-add" class="btn btn-modal elevation-3 rounded-circle bg-success">
        <i class="fas fa-plus fa-2x"></i>
    </div>
</div>

@include('admin.employee.modal-delete', ['form' => 'form-delete-employee'])
@include('admin.employee.modal-down-date')
@include('admin.employee.form-employee', ['title' => 'Add', 'action' => 'add'])
@include('admin.employee.form-employee', ['title' => 'Update', 'action' => 'update'])
@stop

@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('js/ui.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <script src="{{ asset('js/admin-employees.js') }}"></script>
@stop