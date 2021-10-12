<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee | Card</title>
    <link rel="stylesheet" href="{{ asset('css/check-employee.css') }}">
</head>
<body>
    <div class="employee-card" id="employee-card">
        <div class="card-body">
            <div class="perfil" style="background-image: url({{ asset('storage/employee-'.$employee->code.'.jpg') }})"></div>
            <div class="name">
                <h2 class="employee-name">{{ $employee->name.' '.$employee->lastname}}</h2>
            </div>
            <div class="job">
                <h2 class="employee-job">{{ $employee->job}}</h2>
            </div>
            <div class="sede">
                <h2 class="employee-info"><span>SEDE:</span> {{ $employee->sede }}</h2>
            </div>
            <div class="admission_date">
                <h2 class="employee-info"><span>F.D.I:</span> {{ \MyHelpers::formatDateEmployee($employee->admission_date) }}</h2>
            </div>
            <div class="nss">
                <h2 class="employee-info"><span>NSS:</span> {{ $employee->nss }}</h2>
            </div>
            
            @if (request()->routeIs('down.card.employee'))
                @php $visible = 'hidden'; @endphp 
            @else
                @php $visible = 'block'; @endphp 
                <div class="admission_date">
                    <h2 class="employee-info"><span>CODE:</span> {{ $employee->code }}</h2>
                </div>
                    @if ($employee->status == 1)
                        <div class="codo-Promo">
                            <h2 class="employee-info"><span>DESC:</span> {{ $employee->codes->last()->code }}</h2>
                        </div>
                        <div class="status">
                            <h2 class="employee-status status-enabled">Activo</h2>
                        </div>
                    @else
                        <div class="status">
                            <h2 class="employee-status status-disabled">Baja desde <span>{{ \MyHelpers::formatDatEEmployee($employee->down_date ) }}</span></h2>
                        </div>
                    @endif
                
            @endif

        
        </div>
        <div class="card-footer">
            @if($visible == 'hidden')
                <img src="{{ asset('qrcode/qrcode-'.$employee->code.'.png') }}" class="qr-code-employee">
            @endif
            <img src="{{ asset('img/Shaddai_W.png') }}" class="logo">
            <img src="{{ asset('img/base.png') }}" class="wave">
            <img src="{{ asset('img/circle1.png') }}" class="circle-1">
            <img src="{{ asset('img/circle2.png') }}" class="circle-2">
        </div>
    </div>

    @if($visible == 'hidden')
        <div id="down-card">
            <img src="{{ asset('img/download-to-storage-drive.png') }}" alt="Descargar tarjeta" class="icon-down-card">
        </div>
    @endif

    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script src="{{ asset('js/canvas2Image.js') }}"></script>
    <script>
        const cardHeight = document.querySelector('.employee-card').offsetHeight;
        document.querySelector('#down-card').addEventListener('click', function() {
            console.log('click')
            html2canvas(document.querySelector("#employee-card")).then(canvas => {
                //document.body.appendChild(canvas);
                return Canvas2Image.saveAsJPEG(canvas, 500, cardHeight, 'card-{{ $employee->code }}');
            });
        });
        
    </script>
</body>
</html>