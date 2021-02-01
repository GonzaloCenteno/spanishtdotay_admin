@extends('layouts.app')

@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">CREAR CATEGORIA</h5>
        <form id="FormularioCrearCategoria" method="POST" action="{{ route('categoria_blog.store') }}">
        @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-10">
    	                <div class="form-group">
    	                    <label for="nombre" class="col-form-label">*Nombre:</label>
    	                    <input id="nombre" type="text" class="form-control" name="nombre">
                            <span class="invalid-feedback" role="alert" id="error_nombre"><strong></strong></span>
    	                </div>
    	            </div>
    	            <div class="col-2 align-self-center text-center">
    	            	<div class="form-group">
    	                    <label class="custom-control custom-checkbox custom-control-inline">
    		                    <input type="checkbox" checked="" name="estado" class="custom-control-input"><span class="custom-control-label">¿Publicar?</span>
    		                </label>
    	                </div>
    	            </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" id="guardar_data" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Guardar</button>
                <a href="{{ route('categoria_blog.index') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $("#nombre").on('change keyup', function () {
        limpiarErrores($(this).attr('id'));
    });

    $('#FormularioCrearCategoria').submit(function(e){
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            data: new FormData($(this)[0]),
            processData: false,
            contentType: false,
            // beforeSend:function()
            // {            
            //     MensajeDialogLoadAjax('FormularioCrearCategoria', '...:: Cargando ::...');
            // },
            success: function (data) 
            {
                console.log(data);
                // MensajeDialogLoadAjaxFinish('FormularioCrearCategoria');
                // mensajes_sistema(1);
            },
            error: function(error) {
                if (error.status == 422) {
                    // mensajes_sistema(4);
                    var data = error.responseJSON.errors;
                    for(let i in data){
                        mostrarErrores(i,data[i][0]);
                    }
                    // MensajeDialogLoadAjaxFinish('FormularioCrearCategoria');
                }
                else {
                    // mensajes_sistema(3);
                    // MensajeDialogLoadAjaxFinish('FormularioCrearCategoria');
                    console.log('error');
                    console.log(error);
                }
            }
        });
    });
</script>

@stop
@endsection
