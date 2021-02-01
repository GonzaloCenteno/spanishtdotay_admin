@extends('layouts.app')
@section('title', 'Administracion Respuestas') 
@section('content')

<div class="col-12">
    <div class="card">
        <div class="col-12 text-left pt-2">
            <a href="{{ route('respuestas.create') }}" type="button" class="btn btn-outline-primary"><i class="fa fa-plus-circle fa-2x"></i> </a>
        </div>
        <div class="card-body">
            <div class="col-12">         
                <div class="form-group" id="contenedor">
	                <table id="tabla_respuesta"></table>
	                <div id="paginador_tabla_respuesta"></div>                         
	            </div>                                
            </div>
        </div>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#respuestas").addClass("active");

        jQuery("#tabla_respuesta").jqGrid({
            url: 'respuestas/1',
            datatype: 'json', mtype: 'GET',
            height: '400px', autowidth: true,
            toolbarfilter: true,
            forceFit:true,  
            colNames: ['#','RESPUESTA','PREGUNTA','ESTADO'],
            rowNum: 20, sortname: 'id_pregunta', sortorder: 'asc', viewrecords: true, caption: 'LISTADO DE RESPUESTAS', align: "center",
            colModel: [
                {name: 'idrespuesta', index: 'idrespuesta', align: 'left',width: 5, hidden:true},
                {name: 'id_pregunta', index: 'id_pregunta', align: 'left', width: 20},
                {name: 'respuesta', index: 'respuesta', align: 'left', width: 20},
                {name: 'estado', index: 'estado', align: 'center', width: 10}
            ],
            pager: '#paginador_tabla_respuesta',
            rowList: [20, 30, 40, 50],
            gridComplete: function () {
                var idarray = jQuery('#tabla_respuesta').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                var firstid = jQuery('#tabla_respuesta').jqGrid('getDataIDs')[0];
                        $("#tabla_respuesta").setSelection(firstid);    
                    }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){
                let url = "{{ route('respuestas.edit', 'id') }}";
                url = url.replace('id', Id);
                window.location.href = url;
            }
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_respuesta").jqGrid('setGridWidth', $("#contenedor").width());
        });

    });
</script>

@stop
@endsection
