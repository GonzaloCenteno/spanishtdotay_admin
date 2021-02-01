@extends('layouts.app')
@section('title', 'Administracion Ventas') 
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="col-12">         
                <div class="form-group" id="contenedor">
	                <table id="tabla_venta"></table>
	                <div id="paginador_tabla_venta"></div>                         
	            </div>                                
            </div>
        </div>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function(){

        $("#ventas").addClass("active");

        jQuery("#tabla_venta").jqGrid({
            url: 'ventas/1',
            datatype: 'json', mtype: 'GET',
            height: '400px', autowidth: true,
            toolbarfilter: true,
            forceFit:true,  
            colNames: ['ID','PERSONA','CORREO','FECHA','PLAN','DESCRIPCION','PRECIO'],
            rowNum: 20, sortname: 'id_ventadetalle', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE VENTAS', align: "center",
            colModel: [
                {name: 'id_ventadetalle', index: 'id_ventadetalle', align: 'left',width: 5, hidden: true},
                {name: 'nombres', index: 'nombres', align: 'left', width: 15, sortable: false},
                {name: 'email', index: 'email', align: 'left', width: 13, sortable: false},
                {name: 'fecha', index: 'fecha', align: 'center', width: 6, sortable: false},
                {name: 'plan', index: 'plan', align: 'left', width: 10, sortable: false},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 20, sortable: false},
                {name: 'precio', index: 'precio', align: 'center', width: 8, sortable: false}
            ],
            pager: '#paginador_tabla_venta',
            rowList: [20, 30, 40, 50],
            gridComplete: function () {
                var idarray = jQuery('#tabla_venta').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                var firstid = jQuery('#tabla_venta').jqGrid('getDataIDs')[0];
                        $("#tabla_venta").setSelection(firstid);    
                    }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_venta").jqGrid('setGridWidth', $("#contenedor").width());
        });

    });
</script>

@stop

@endsection
