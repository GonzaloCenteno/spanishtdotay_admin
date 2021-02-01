@extends('layouts.app')
@section('title', 'Administracion Free Trial') 
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="col-12">         
                <div class="form-group" id="contenedor">
	                <table id="tabla_free_trial"></table>
	                <div id="paginador_tabla_free_trial"></div>                         
	            </div>                                
            </div>
        </div>
    </div>
</div>

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#free_trial").addClass("active");

        jQuery("#tabla_free_trial").jqGrid({
            url: 'free_trial/1',
            datatype: 'json', mtype: 'GET',
            height: '400px', autowidth: true,
            toolbarfilter: true,
            forceFit:true,  
            colNames: ['ID','NOMBRE','CORREO','FECHA','HORA','ZONA HORARIA','DELE'],
            rowNum: 20, sortname: 'id_freetrial', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE FREE TRIAL', align: "center",
            colModel: [
                {name: 'id_freetrial', index: 'id_freetrial', align: 'left',width: 5, hidden: true},
                {name: 'nombre', index: 'nombre', align: 'left', width: 20},
                {name: 'correo', index: 'correo', align: 'left', width: 15},
                {name: 'fecha', index: 'fecha', align: 'center', width: 10},
                {name: 'hora', index: 'hora', align: 'center', width: 10},
                {name: 'zona_horaria', index: 'zona_horaria', align: 'left', width: 10},
                {name: 'dele', index: 'dele', align: 'center', width: 5}
            ],
            pager: '#paginador_tabla_free_trial',
            rowList: [20, 30, 40, 50],
            gridComplete: function () {
                var idarray = jQuery('#tabla_free_trial').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                var firstid = jQuery('#tabla_free_trial').jqGrid('getDataIDs')[0];
                        $("#tabla_free_trial").setSelection(firstid);    
                    }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_free_trial").jqGrid('setGridWidth', $("#contenedor").width());
        });

    });
</script>

@stop
@endsection
