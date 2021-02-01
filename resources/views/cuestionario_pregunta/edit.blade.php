@extends('layouts.app')

@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">ASIGNAR PREGUNTAS</h5>
        <form>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12">
    	                <div class="form-group">
    	                    <label for="cuestionario" class="col-form-label">*Cuestionario:</label>
    	                    <input type="text" class="form-control text-center" disabled value="{{ $cuestionario->nombre }}">
    	                </div>
    	            </div>
                    <div class="col-12">         
                        <div class="form-group" id="contenedor">
                            <table id="tabla_cuestionario_pregunta"></table>
                            <div id="paginador_tabla_cuestionario_pregunta"></div>                         
                        </div>                                
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('cuestionarios.index') }}" class="btn btn-outline-danger btn-sm">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">

    $(document).ready(function(){
        $("#cuestionarios").addClass("active");

        jQuery("#tabla_cuestionario_pregunta").jqGrid({
            url: '{{ route("cuestionario_pregunta.show", $cuestionario->id_cuestionario) }}',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            forceFit:true,  
            colNames: ['#','NOMBRE','SELECCION'],
            rowNum: 30, sortname: 'id_pregunta', sortorder: 'asc', viewrecords: true, caption: 'LISTADO DE PREGUNTAS', align: "center",
            colModel: [
                {name: 'id_pregunta', index: 'id_pregunta', align: 'center',width: 5},
                {name: 'pregunta', index: 'pregunta', align: 'left', width: 50},
                {name: 'seleccion', index: 'seleccion', align: 'center', width: 10, sortable:false}
            ],
            pager: '#paginador_tabla_cuestionario_pregunta',
            rowList: [30, 60, 90, 100]
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_cuestionario_pregunta").jqGrid('setGridWidth', $("#contenedor").width());
        });

    });

    function agregar(id_cuestionario, id_pregunta)
    {
        $.ajax({
            url: "{{ route('cuestionario_pregunta.store') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                id_cuestionario: id_cuestionario,
                id_pregunta: id_pregunta
            },
            success: function (data) 
            {
                jQuery("#tabla_cuestionario_pregunta").jqGrid('setGridParam', {
                    url: '{{ route("cuestionario_pregunta.show", $cuestionario->id_cuestionario) }}'
                }).trigger('reloadGrid');
                swal.close();
            }
        });
    }

    function eliminar(id_cuestionariopregunta)
    {
        let url = "{{ route('cuestionario_pregunta.destroy', 'id') }}";
            url = url.replace('id', id_cuestionariopregunta);
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                _method: 'delete',
            },
            success: function (data) 
            {
                jQuery("#tabla_cuestionario_pregunta").jqGrid('setGridParam', {
                    url: '{{ route("cuestionario_pregunta.show", $cuestionario->id_cuestionario) }}'
                }).trigger('reloadGrid');
                swal.close();
            }
        });
    }
</script>

@stop
@endsection
