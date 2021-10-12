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

<h1>Aquí habrá contenido de todo</h1>

@include('admin.employee.modal-delete', ['form' => 'nothing'])
@include('admin.employee.modal-down-date')
@include('admin.employee.form-employee', ['title' => 'Add', 'action' => 'add'])
@include('admin.employee.form-employee', ['title' => 'Update', 'action' => 'update'])
@stop

@section('js')
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('js/ui.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
@stop