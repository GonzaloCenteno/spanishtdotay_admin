@extends('layouts.app')

@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">MODIFICAR RESPUESTAS</h5>
        <form id="FormularioModificarRespuesta" method="POST" action="{{ route('respuestas.update', $respuesta->id_respuesta) }}">
        @csrf
        @method('PUT')
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12">
    	                <div class="form-group">
    	                    <label for="respuesta" class="col-form-label">*Respuesta:</label>
    	                    <input id="respuesta" type="text" class="form-control" name="respuesta" autocomplete="off" value="{{ $respuesta->respuesta }}">
                            <span class="invalid-feedback" role="alert" id="error_respuesta"><strong></strong></span>
    	                </div>
    	            </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="id_pregunta" class="col-form-label">*Pregunta:</label>
                            <select id="id_pregunta" name="id_pregunta" class="form-control">
                                @foreach($pregunta as $pre)
                                    <option value="{{ $pre->id_pregunta }}" {{ $pre->id_pregunta == $respuesta->id_pregunta ? 'selected' : '' }}>{{ $pre->pregunta }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert" id="error_id_pregunta"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="estado" class="col-form-label">*Estado:</label>
                            <select id="estado" name="estado" class="form-control">
                                <option value="1" {{ 'CORRECTA' == $respuesta->estado ? 'selected' : '' }}>CORRECTA</option>  
                                <option value="2" {{ 'INCORRECTA' == $respuesta->estado ? 'selected' : '' }}>INCORRECTA</option>  
                            </select>
                            <span class="invalid-feedback" role="alert" id="error_estado"><strong></strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Modificar</button>
                <a href="{{ route('respuestas.index') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">

    $("#respuestas").addClass("active");

    $("#respuesta, #idpregunta, #estado").on('change keyup', function () {
        limpiarErrores($(this).attr('id'));
    });

    $('#FormularioModificarRespuesta').submit(function(e){
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
                alertas(2,'respuestas');
            }
        });
    });
</script>

@stop
@endsection
