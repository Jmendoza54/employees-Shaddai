@if ($status == 1)
    <div type="button" data-target="{{$id}}" class="btn-down-date">
        <i class="fas fa-check-circle text-success"></i>
    </div>
@else
    <i class="fas fa-ban text-danger"></i>
@endif