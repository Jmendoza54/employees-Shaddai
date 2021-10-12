@if (request()->routeIs('table.employees'))
    <a href="{{ route('down.card.employee', ['code' => $code]) }}" target="_blank">
        <div class="btn-action btn-view d-inline-flex p-1 btn elevation-2">
            <i class="fas fa-eye text-primary"></i>
        </div>
    </a> 
@endif
<div class="btn-action btn-edit d-inline-flex p-1 btn elevation-2" data-target="{{$id}}">
    <i class="fas fa-edit text-warning"></i>
</div>
@can('delete.employee')
    <div class="btn-action btn-delete d-inline-flex p-1 btn elevation-2" data-target="{{$id}}">
        <i class="far fa-trash-alt text-danger"></i>
    </div>
@endcan
