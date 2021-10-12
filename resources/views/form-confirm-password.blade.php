<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shaddai Group | Confirm Password</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/apply-code.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
           <div class="col-lg-12">
            <div class="card bg-shaddai">
                <h5 class="card-header text-center">
                    Shaddai Group - Confirmar Password 
                </h5>
                <div class="col-lg-12 py-3">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 col-md-12">
                            <img src="{{ asset('img/Shaddai_W.png') }}" alt="Logo Shaddai Group" class="logo-shaddai">
                        </div>
                        <div class="col-lg-8 col-sm-12 d-flex flex-column justify-content-center">
                           @isset($msg)
                               <h2>{{ $msg }}</h2>
                           @endisset
                                
                            @isset($code)
                                <form action="" id="form-confirm-pwd">
                                    @csrf 
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="code">Ingresa Password</label>
                                            <input type="password" class="form-control" name="password" required>
                                            <input type="hidden" class="form-control" name="code" value="{{ $code }}" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-light">Confirmar Password</button>
                                    
                                </form>
                                @include('partials.modal-apply-code', ['title' => 'Verificando Password'])
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="{{ asset('js/ui.js') }}"></script>
    <script src="{{ asset('js/confirm-pass.js') }}"></script>
</body>
</html>
{{-- test --}}