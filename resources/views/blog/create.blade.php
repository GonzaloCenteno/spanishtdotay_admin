@extends('layouts.app')

@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">CREAR BLOG</h5>
        <form id="FormularioCrearBlog" method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="titulo" class="col-form-label">*Categoria:</label>
                            <select class="form-control" name="idcategoriablog">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->idcategoriablog }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                            <!-- <span class="invalid-feedback" role="alert" id="error_titulo"><strong></strong></span> -->
                        </div>
                    </div>
                    <div class="col-8">
    	                <div class="form-group">
    	                    <label for="titulo" class="col-form-label">*Titulo:</label>
    	                    <input id="titulo" type="text" class="form-control" name="titulo">
                            <span class="invalid-feedback" role="alert" id="error_titulo"><strong></strong></span>
    	                </div>
    	            </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="subtitulo" class="col-form-label">*Subtitulo:</label>
                            <input id="subtitulo" type="text" class="form-control" name="subtitulo">
                            <span class="invalid-feedback" role="alert" id="error_subtitulo"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="imagen" class="col-form-label">*Imagen Principal:</label>
                            <input id="imagen" type="file" class="form-control" name="imagen">
                            <span class="invalid-feedback" role="alert" id="error_imagen"><strong></strong></span>
                        </div>
                    </div>
                    <div class="col-1 align-self-center text-center">
                        <div class="form-group">
                            <label class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" checked="" name="estado" class="custom-control-input"><span class="custom-control-label">¿Publicar?</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                            <label for="contenido" class="col-form-label">*Contenido:</label>
                            <textarea id="contenido" name="contenido"></textarea>
                            <span class="invalid-feedback" role="alert" id="error_contenido"><strong></strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" id="guardar_data" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Guardar</button>
                <a href="{{ route('blog.index') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">

    $("#nombre").on('change keyup', function () {
        limpiarErrores($(this).attr('id'));
    });

    $('#FormularioCrearBlog').submit(function(e){
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
            //     MensajeDialogLoadAjax('FormularioCrearBlog', '...:: Cargando ::...');
            // },
            success: function (data) 
            {
                console.log(data);
                // MensajeDialogLoadAjaxFinish('FormularioCrearBlog');
                // mensajes_sistema(1);
            },
            error: function(error) {
                if (error.status == 422) {
                    // mensajes_sistema(4);
                    var data = error.responseJSON.errors;
                    for(let i in data){
                        mostrarErrores(i,data[i][0]);
                    }
                    // MensajeDialogLoadAjaxFinish('FormularioCrearBlog');
                }
                else {
                    // mensajes_sistema(3);
                    // MensajeDialogLoadAjaxFinish('FormularioCrearBlog');
                    console.log('error');
                    console.log(error);
                }
            }
        });
    });
</script>

@stop
@endsection
