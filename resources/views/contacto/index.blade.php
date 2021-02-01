@extends('layouts.app')
@section('title', 'Administracion Contactos') 
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="col-12">         
                <div class="form-group" id="contenedor">
	                <table id="tabla_contacto"></table>
	                <div id="paginador_tabla_contacto"></div>                         
	            </div>                                
            </div>
        </div>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#contactos").addClass("active");

        jQuery("#tabla_contacto").jqGrid({
            url: 'contactos/1',
            datatype: 'json', mtype: 'GET',
            height: '400px', autowidth: true,
            toolbarfilter: true,
            forceFit:true,  
            colNames: ['ID','NOMBRE','CORREO','MENSAJE','FECHA CREACION'],
            rowNum: 20, sortname: 'id_contacto', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE CONTACTOS', align: "center",
            colModel: [
                {name: 'id_contacto', index: 'id_contacto', align: 'left',width: 5, hidden: true},
                {name: 'nombre', index: 'nombre', align: 'left', width: 20},
                {name: 'correo', index: 'correo', align: 'left', width: 15},
                {name: 'mensaje', index: 'mensaje', align: 'left', width: 30},
                {name: 'fecha_creacion', index: 'fecha_creacion', align: 'center', width: 15},
            ],
            pager: '#paginador_tabla_contacto',
            rowList: [20, 30, 40, 50],
            gridComplete: function () {
                var idarray = jQuery('#tabla_contacto').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                var firstid = jQuery('#tabla_contacto').jqGrid('getDataIDs')[0];
                        $("#tabla_contacto").setSelection(firstid);    
                    }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_contacto").jqGrid('setGridWidth', $("#contenedor").width());
        });

    });
</script>

@stop
@endsection
