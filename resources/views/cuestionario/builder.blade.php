@extends('layouts.app')

@section('content')

<div class="col-12">
    <div class="card">
        <form id="FormularioCreacionCuestionario" method="POST" onkeydown="return event.key != 'Enter';" action="{{ route('CrearCuestionario') }}" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="card">
                    <h3 class="card-header text-center">CUESTIONARIO</h3>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-8">
                                <div class="form-group">
                                    <input placeholder="ESCRIBIR NOMBRE..." id="nombre_cuestionario" type="text" class="form-control" name="nombre_cuestionario" autocomplete="off" autofocus>
                                    <span class="invalid-feedback" role="alert" id="error_nombre_cuestionario"><strong></strong></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input id="imagen" type="file" class="form-control" name="imagen">
                                    <span class="invalid-feedback" role="alert" id="error_imagen"><strong></strong></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input placeholder="ESCRIBIR RESUMEN..." id="resumen" type="text" class="form-control" name="resumen" autocomplete="off">
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
                                    <textarea id="descripcion" name="descripcion" class="contenido">REDACTAR CONTENIDO...</textarea>
                                    <span class="invalid-feedback" role="alert" id="error_descripcion"><strong></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="form-row">
                        <div class="col-2 col-sm-1 text-right pt-2">
                            <button type="button" id="btn_agregar_preguntas" class="btn btn-outline-primary btn-block"><i class="fa fa-plus fa-2x"></i> </button>
                        </div>
                        <div class="col-10 col-sm-10 text-center pt-2">
                            <h3 class="card-header text-center">PREGUNTAS</h3>
                        </div>
                    </div>
                    
                    <div class="card-body" id="cuerpo_preguntas"></div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Guardar</button>
                <a href="{{ route('cuestionarios.index') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    var indice_pregunta = 0;
    var indice_respuesta = 0;
    $("#btn_agregar_preguntas").click( () => { 
        indice_pregunta++;
        let pregunta = `<div class="card" id="card_principal_${indice_pregunta}">
                            <div class="card-header" style="background-color: #F3F3F3">
                                <div class="form-row">
                                    <div class="col-11">
                                        <div class="form-group">
                                            <input type="hidden" name="selector_pregunta[]" value="${indice_pregunta}">
                                            <input onchange="eliminarArregloErrores(this)" placeholder="ESCRIBIR PREGUNTA..." type="text" class="form-control" name="nombre_pregunta[]" autocomplete="off">
                                            <span class="invalid-feedback" role="alert" id="error_nombre_pregunta[]"></span>
                                        </div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <div class="form-group">
                                            <button type="button" onclick="eliminar_pregunta(${indice_pregunta})" class="btn btn-sm btn-outline-danger btn-block"><i class="fa fa-times"></i> </button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input placeholder="ESCRIBIR DETALLE..." type="text" class="form-control" name="detalle[]" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input onchange="eliminarArregloErrores(this)" placeholder="ESCRIBIR CALIFICACION..." type="number" class="form-control" name="calificacion[]" autocomplete="off">
                                            <span class="invalid-feedback" role="alert" id="error_calificacion[]"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select name="tipo[]" class="form-control">
                                                <option value="1">UNICA RESPUESTA</option>  
                                                <option value="2">MULTIRESPUESTA</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input onchange="eliminarArregloErrores(this)" placeholder="CANTIDAD DE RESPUESTAS CORRECTAS..." type="number" class="form-control" name="cantidadCorrectas[]" autocomplete="off">
                                            <span class="invalid-feedback" role="alert" id="error_cantidadCorrectas[]"><strong></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-2 col-sm-1 text-right pt-2">
                                        <button type="button" onclick="agregar_respuestas(${indice_pregunta})" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i> </button>
                                    </div>
                                    <div class="col-10 col-sm-10 text-left pt-2">
                                        <h3 class="card-header">RESPUESTAS</h3>
                                    </div>
                                </div>
                                <div class="form-row" id="cuerpo_respuesta_${indice_pregunta}"></div>
                            </div>
                        </div>`;
        $("#cuerpo_preguntas").append(pregunta);
    });

    function eliminarArregloErrores(el)
    {
        $('span[id="error_'+el.name+'"]:eq('+$(el)[0].dataset.indice+')').hide();
        $('span[id="error_'+el.name+'"]:eq('+$(el)[0].dataset.indice+')').text('');
        $('input[name="'+el.name+'"]:eq('+$(el)[0].dataset.indice+')').removeClass('is-invalid');
    }

    function eliminar_pregunta(indice)
    {
        $("#card_principal_"+indice).remove();
    }

    function eliminar_respuesta(indice)
    {
        $("#div_respuesta_"+indice).remove();
    }

    function agregar_respuestas(indice)
    {
        indice_respuesta++;
        let respuesta = `<div class="container row" id="div_respuesta_${indice_respuesta}">
                            <div class="col-7 offset-1">
                                <div class="form-group">
                                    <input type="hidden" name="selector_respuesta[]" value="${indice}">
                                    <input onchange="eliminarArregloErrores(this)" placeholder="ESCRIBIR RESPUESTA..." type="text" class="form-control" name="respuesta[]" autocomplete="off">
                                    <span class="invalid-feedback" role="alert" id="error_respuesta[]"><strong></strong></span>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <select name="estado[]" class="form-control">
                                        <option value="1">CORRECTA</option>  
                                        <option value="2">INCORRECTA</option>  
                                    </select>
                                </div>
                            </div>
                            <div class="col-1 text-center">
                                <div class="form-group">
                                    <button type="button" onclick="eliminar_respuesta(${indice_respuesta})" class="btn btn-sm btn-outline-danger btn-block"><i class="fa fa-times"></i> </button>
                                </div>
                            </div>
                        </div>`
        $("#cuerpo_respuesta_"+indice).append(respuesta);
    }

    $("#cuestionarios").addClass("active");

    $("#nombre_cuestionario, #descripcion, #resumen, #imagen, #url").on('change keyup', function () {
        limpiarErrores($(this).attr('id'));
    });

    $('#FormularioCreacionCuestionario').submit(function(e){
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
