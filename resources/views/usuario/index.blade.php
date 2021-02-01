@extends('layouts.app')
@section('title', 'Administracion Usuario') 
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form id="FormularioModificarUsuario" method="POST" action="{{ route('usuario.update', $usuario->idusuario) }}">
            @csrf
                <div class="card-body">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">*Nombre:</label>
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $usuario->nombre }}">
                                <span class="invalid-feedback" role="alert" id="error_nombre"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email" class="col-form-label">*Email:</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{ $usuario->email }}">
                                <span class="invalid-feedback" role="alert" id="error_email"><strong></strong></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password" class="col-form-label">*Contraseña:</label>
                                <input id="password" type="password" class="form-control" name="password">
                                <span class="invalid-feedback" role="alert" id="error_password"><strong></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Guardar</button>
                    <a href="{{ route('ventas.index') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $("#nombre, #email").on('change keyup', function () {
        limpiarErrores($(this).attr('id'));
    });

    $('#FormularioModificarUsuario').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            data: new FormData($(this)[0]),
            processData: false,
            contentType: false,
            success: function (data) 
            {
                let timerInterval
                swal({
                    type: 'success',
                    title: 'ÉXITO',
                    timer: 1600,
                    allowOutsideClick: false,
                    allowEscapeKey:false,
                    showConfirmButton: false,
                    onOpen: () => {
                        timerInterval = setInterval(() => {
                        }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                });
            }
        });
    });
</script>

@stop

@endsection
