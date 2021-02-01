@extends('layouts.app')
@section('title', 'Administracion Cuestionario') 
@section('content')

<div class="col-12">
    <div class="card">
        <div class="form-row">
            <div class="col-2 col-sm-1 text-right pt-2">
                <a href="{{ route('cuestionarios.create',['tipo' => '1']) }}" type="button" class="btn btn-outline-primary"><i class="fa fa-plus-circle fa-2x"></i> </a>
            </div>
            <div class="col-2 col-sm-1 text-left pt-2">
                <a href="{{ route('cuestionarios.create',['tipo' => '2']) }}" type="button" class="btn btn-outline-secondary"><i class="fa fa-file fa-2x"></i> </a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-12">         
                <div class="form-group" id="contenedor">
	                <table id="tabla_cuestionario"></table>
	                <div id="paginador_tabla_cuestionario"></div>                         
	            </div>                                
            </div>
        </div>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#cuestionarios").addClass("active");

        jQuery("#tabla_cuestionario").jqGrid({
            url: 'cuestionarios/1',
            datatype: 'json', mtype: 'GET',
            height: '400px', autowidth: true,
            toolbarfilter: true,
            forceFit:true,  
            colNames: ['#','NOMBRE','ASIGNAR','PUBLICACION'],
            rowNum: 20, sortname: 'id_cuestionario', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE CUESTIONARIOS', align: "center",
            colModel: [
                {name: 'id_cuestionario', index: 'id_cuestionario', align: 'center',width: 5},
                {name: 'nombre', index: 'nombre', align: 'left', width: 40},
                {name: 'btn_asignar', index: 'btn_asignar', align: 'left', width: 10, sortable:false},
                {name: 'publicacion', index: 'publicacion', align: 'center', width: 10, sortable:false}
            ],
            pager: '#paginador_tabla_cuestionario',
            rowList: [20, 30, 40, 50],
            gridComplete: function () {
                var idarray = jQuery('#tabla_cuestionario').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                var firstid = jQuery('#tabla_cuestionario').jqGrid('getDataIDs')[0];
                        $("#tabla_cuestionario").setSelection(firstid);    
                    }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){
                let url = "{{ route('cuestionarios.edit', 'id') }}";
                url = url.replace('id', Id);
                window.location.href = url;
            }
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_cuestionario").jqGrid('setGridWidth', $("#contenedor").width());
        });

    });

    function cambiar_estado(id_cuestionario, estado)
    {
        let url = "{{ route('CambiarEstado', 'id_cuestionario') }}";
            url = url.replace('id_cuestionario', id_cuestionario);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {
                estado: estado,
            },
            success: function (data) 
            {
                jQuery("#tabla_cuestionario").jqGrid('setGridParam', {
                    url: 'cuestionarios/1'
                }).trigger('reloadGrid');
                swal.close();
            }
        });
    }
</script>

@stop
@endsection
