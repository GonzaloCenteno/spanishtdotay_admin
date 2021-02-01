@extends('layouts.app')
@section('title', 'Administracion Preguntas') 
@section('content')

<div class="col-12">
    <div class="card">
        <div class="col-12 text-left pt-2">
            <a href="{{ route('preguntas.create') }}" type="button" class="btn btn-outline-primary"><i class="fa fa-plus-circle fa-2x"></i> </a>
        </div>
        <div class="card-body">
            <div class="col-12">         
                <div class="form-group" id="contenedor">
	                <table id="tabla_pregunta"></table>
	                <div id="paginador_tabla_pregunta"></div>                         
	            </div>                                
            </div>
        </div>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#preguntas").addClass("active");

        jQuery("#tabla_pregunta").jqGrid({
            url: 'preguntas/1',
            datatype: 'json', mtype: 'GET',
            height: '400px', autowidth: true,
            toolbarfilter: true,
            forceFit:true,  
            colNames: ['#','NOMBRE','CALIFICACION','TIPO','CANT. CORRECTAS','CAL. RESPUESTA'],
            rowNum: 20, sortname: 'id_pregunta', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE PREGUNTAS', align: "center",
            colModel: [
                {name: 'id_pregunta', index: 'id_pregunta', align: 'left',width: 5, hidden:true},
                {name: 'pregunta', index: 'pregunta', align: 'left', width: 25},
                {name: 'calificacion', index: 'calificacion', align: 'center', width: 10},
                {name: 'tipo', index: 'tipo', align: 'center', width: 14},
                {name: 'cantidadCorrectas', index: 'cantidadCorrectas', align: 'center', width: 10},
                {name: 'calificacionRespuesta', index: 'calificacionRespuesta', align: 'center', width: 10}
            ],
            pager: '#paginador_tabla_pregunta',
            rowList: [20, 30, 40, 50],
            gridComplete: function () {
                var idarray = jQuery('#tabla_pregunta').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                var firstid = jQuery('#tabla_pregunta').jqGrid('getDataIDs')[0];
                        $("#tabla_pregunta").setSelection(firstid);    
                    }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){
                let url = "{{ route('preguntas.edit', 'id') }}";
                url = url.replace('id', Id);
                window.location.href = url;
            }
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_pregunta").jqGrid('setGridWidth', $("#contenedor").width());
        });

    });
</script>

@stop
@endsection
