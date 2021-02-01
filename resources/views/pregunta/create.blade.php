@extends('layouts.app')

@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">CREAR PREGUNTAS</h5>
        <form id="FormularioCrearPregunta" method="POST" action="{{ route('preguntas.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12">
    	                <div class="form-group">
    	                    <label for="pregunta" class="col-form-label">*Pregunta:</label>
    	                    <input id="pregunta" type="text" class="form-control" name="pregunta" autocomplete="off">
                            <span class="invalid-feedback" role="alert" id="error_pregunta"><strong></strong></span>
    	                </div>
    	            </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="detalle" class="col-form-label">*Detalle:</label>
                            <input id="detalle" type="text" class="form-control" name="detalle" autocomplete="off">
                            <span class="invalid-feedback" role="alert" id="error_detalle"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="calificacion" class="col-form-label">*Calificacion:</label>
                            <input id="calificacion" type="number" class="form-control" name="calificacion" autocomplete="off">
                            <span class="invalid-feedback" role="alert" id="error_calificacion"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="tipo" class="col-form-label">*Tipo:</label>
                            <select id="tipo" name="tipo" class="form-control">
                                <option value="1">UNICA RESPUESTA</option>  
                                <option value="2">MULTIRESPUESTA</option>  
                            </select>
                            <span class="invalid-feedback" role="alert" id="error_tipo"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="cantidadCorrectas" class="col-form-label">*Cantidad Correctas:</label>
                            <input id="cantidadCorrectas" type="number" class="form-control" name="cantidadCorrectas" autocomplete="off">
                            <span class="invalid-feedback" role="alert" id="error_cantidadCorrectas"><strong></strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Guardar</button>
                <a href="{{ route('preguntas.index') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">

    $("#preguntas").addClass("active");
    $("#pregunta").focus();

    $("#pregunta, #detalle, #calificacion, #cantidadCorrectas").on('change keyup', function () {
        limpiarErrores($(this).attr('id'));
    });

    $('#FormularioCrearPregunta').submit(function(e){
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
                alertas(2,'preguntas');
            }
        });
    });
</script>

@stop
@endsection
