@extends('layouts.principal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1 style="color: #e86e48;">Bienvenida</h1></br></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Acá podrás crear las encuestas que quieras para MiAutonomía, en el menú de la izquierda puedes ver las opciones que tenemos para ti.</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
