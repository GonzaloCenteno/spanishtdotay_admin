@extends('layouts.app')

@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">CREAR CUESTIONARIO</h5>
        <form id="FormularioCrearCuestionario" method="POST" action="{{ route('cuestionarios.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-8">
    	                <div class="form-group">
    	                    <label for="nombre" class="col-form-label">*Nombre:</label>
    	                    <input id="nombre" type="text" class="form-control" name="nombre" autocomplete="off">
                            <span class="invalid-feedback" role="alert" id="error_nombre"><strong></strong></span>
    	                </div>
    	            </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="imagen" class="col-form-label">*Imagen:</label>
                            <input id="imagen" type="file" class="form-control" name="imagen">
                            <span class="invalid-feedback" role="alert" id="error_imagen"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="resumen" class="col-form-label">*Resumen:</label>
                            <input id="resumen" type="text" class="form-control" name="resumen" autocomplete="off">
                            <span class="invalid-feedback" role="alert" id="error_resumen"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="url" class="col-form-label">URL:</label>
                            <input id="url" type="text" class="form-control" name="url" autocomplete="off">
                            <span class="invalid-feedback" role="alert" id="error_url"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <label for="descripcion" class="col-form-label">*Descripcion:</label>
                            <textarea id="descripcion" name="descripcion" class="contenido"></textarea>
                            <span class="invalid-feedback" role="alert" id="error_descripcion"><strong></strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" id="guardar_data" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Guardar</button>
                <a href="{{ route('cuestionarios.index') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">

    $("#cuestionarios").addClass("active");
    $("#nombre").focus();

    $("#nombre, #descripcion, #resumen, #imagen, #url").on('change keyup', function () {
        limpiarErrores($(this).attr('id'));
    });

    $('#FormularioCrearCuestionario').submit(function(e){
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
                alertas(2,'cuestionarios');
            }
        });
    });
</script>

@stop
@endsection
