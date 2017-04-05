/**
 * Created by Administrador on 10/02/2017.
 */
//Obtener los valores de los text box
var divValue, values='';
var arrayValues=[];
var diasEjecutables=0;
var iCnt=0;
var estadoRecibido;
var edit=0;
var idFrecuencia=null;

function obtenerIDF($id) {
    idFrecuencia=$id;
}

function validarCambioEstadoFrecuencia(estadoRecibido){

    if(estadoRecibido==="Inactivo") {
        document.getElementById("justificacionEstadoFrecuencia"+idFrecuencia).style.display = "block";
        document.getElementById("informacionEstadoFrecuencia"+idFrecuencia).style.display="block";
    }
    if(estadoRecibido==="Activo"){
        document.getElementById("informacionEstadoFrecuencia"+idFrecuencia).style.display="none";
        document.getElementById("justificacionEstadoFrecuencia"+idFrecuencia).style.display="none";

    }
}

function validarFrecuencia(estado) {
    estadoRecibido=estado;
    document.getElementById("diasE").value='';

    edit=0;
    if (estadoRecibido === '2') /*Semanal*/ {
        $("#modalFSemanal").modal({backdrop: "static"});
        $("#modalFSemanal").modal("show");
    }
    
    if (estadoRecibido === '3') /*Mensual*/ {
        $("#modalFMensual").modal({backdrop: "static"});
        $("#modalFMensual").modal("show");
    }

    if (estadoRecibido === '1') /*Diaria*/{
        document.getElementById("diasFrecuencia").style.display = "block";
        document.getElementById("diasE").value='Todos';
        arrayValues.length=0;
        valor= document.getElementById("diasE").value;
        values+=valor+' ';
        arrayValues.push(valor);
        document.getElementById("tamano").value=arrayValues.length;

    }

    if (estadoRecibido === '4') /*Demanda*/ {
        document.getElementById("diasFrecuencia").style.display = "block";
        document.getElementById("diasE").value='No aplica';

        arrayValues.length=0;
        valor= document.getElementById("diasE").value;
        values+=valor+' ';
        arrayValues.push(valor);
        document.getElementById("tamano").value=arrayValues.length;
    }
};



function validarFrecuenciaEdit(estado) {
    estadoRecibido=estado;

    if (estadoRecibido === '1')/*DIARIO*/ {

        document.getElementById("diasE"+idProceso).value='Todos';
        arrayValues.length=0;
        valor= document.getElementById("diasE"+idProceso).value;
        values+=valor+' ';
        arrayValues.push(valor);
        document.getElementById("tamano"+idProceso).value=arrayValues.length;
        document.getElementById("dias"+idProceso).value=arrayValues;
    }

    if (estadoRecibido === '2')/*SEMANAL*/ {
        $("#modalFSemanalE").modal({backdrop: "static"});
        $("#modalFSemanalE").modal("show");
    }

    if (estadoRecibido === '3')/*MENSUAL*/ {
        $("#modalFMensualE").modal({backdrop: "static"});
        $("#modalFMensualE").modal("show");
    }

    if (estadoRecibido === '4')/*DEMANDA*/ {
        document.getElementById("diasE"+idProceso).value='No aplica';
        arrayValues.length=0;
        valor= document.getElementById("diasE"+idProceso).value;
        values+=valor+' ';
        arrayValues.push(valor);
        document.getElementById("tamano"+idProceso).value=arrayValues.length;
        document.getElementById("dias"+idProceso).value=arrayValues;
    }

    edit=1;
};

function GetTextValueEdit() {

    if(estadoRecibido=='2')/*SEMANAL*/{
        values=" ";
        arrayValues.length=0;
        $('.input-dia').each(function () {
            divValue= $(document.createElement('div'));
            values+=this.value+' ';
            arrayValues.push(this.value);
        });

        document.getElementById("diasE"+idProceso).value= values;
        $("#modalFSemanalE").modal("hide");
        document.getElementById("tamano"+idProceso).value=arrayValues.length;
    }
    else{
        values=" ";
        arrayValues.length=0;

        valor=document.getElementById("diaMes").value;
        values+=valor+' ';
            console.log("Valores",values);
            arrayValues.push(valor);

        document.getElementById("diasE"+idProceso).value= values;
        $("#modalFMensualE").modal("hide");

        document.getElementById("tamano"+idProceso).value=arrayValues.length;
        document.getElementById("dias"+idProceso).value=arrayValues;
    }
}



function GetTextValue() {
    arrayValues.length=0;
    if(estadoRecibido=='2')/*SEMANAL*/{
        values=" ";
        $('.input-dia').each(function () {
            divValue= $(document.createElement('div'));
            values+=this.value+' ';
            arrayValues.push(this.value);
        });

        document.getElementById("diasFrecuencia").style.display = "block";
        document.getElementById("diasE").value= values;
        document.getElementById("tamano").value=arrayValues.length;
        $("#modalFSemanal").modal("hide");
    }else{
        values=" ";
        $('.input-mes').each(function () {
            values+=this.value+' ';
            arrayValues.push(this.value);
        });
        document.getElementById("diasFrecuencia").style.display = "block";
        document.getElementById("diasE").value= values;
        document.getElementById("tamano").value=arrayValues.length;
        $("#modalFMensual").modal("hide");
    }
}


function Cancelar() {
    document.getElementById("diasE"+idProceso).value=dias;
    document.getElementById("FrecuenciaFK"+idProceso).value=frecuencia;

    arrayValues.length=0;

    if(frecuencia!="2"){
        valor= document.getElementById("diasE"+idProceso).value;
        values+=valor+' ';
        arrayValues.push(valor);
    }

    document.getElementById("tamano"+idProceso).value=arrayValues.length;
    document.getElementById("dias"+idProceso).value=arrayValues;
}

function CancelarNuevo() {
    document.getElementById("diasFrecuencia").style.display = "none";
    document.getElementById("diasE").value="";
    document.getElementById("frecuencia").value=0;
    arrayValues.length=0;


   var uno= document.getElementById("tamano").value=arrayValues.length;
    var dos= document.getElementById("dias").value=arrayValues;
    alert("Tamaño"+uno);
    alert("Dias"+dos);
}



$(document).ready(function () {
    //Crea elemento div
    var container= $(document.createElement('form'));
    container.attr('class', 'form-inline');
    container.css({'margin-left':'50px'});
    var divSubmit= $(document.createElement('div'));

    $('#btnDias').click(function () {
        console.log("Entre!");
        diasEjecutables = document.getElementById('diasEjecucion').value;
        console.log("Los dias para ejecutar son"+diasEjecutables);
        do{
            iCnt=iCnt+1;
            $(container).append('<div class="form-group">'+
                '<label class="col-md-2 control-label" for="dia'+iCnt+'">Dia:</label>'+
                '<div  class="col-md-9">'+
                '<input type="text" class="form-control input-md input-dia" id="dia' +iCnt +  '" />'+
                '</div>'+'<button href="#" class="btn btn-danger btn-xs eliminar" style="border-radius: 10px 0px;">&times;</button>'+
                '</div>');

                if(edit==1){
                    if(iCnt==1){
                        $(divSubmit).append('<br>'+'<button class="btn btn-success" style="float: right" onclick="GetTextValueEdit()"'+'id="btSubmit"'+'>Registrar'+'</button>');
                    }
                }else{
                    if(iCnt==1){
                        $(divSubmit).append('<br>'+'<button class="btn btn-success" style="float: right" onclick="GetTextValue()"'+'id="btSubmit"'+'>Registrar'+'</button>');
                    }
                }
            $('#main').after(container, divSubmit);

        }while(iCnt<diasEjecutables){
            $('#btnDias').attr('disabled', 'disabled');
        }

    });


    $("body").on("click",".eliminar", function(e){ //click en eliminar campo

        if( iCnt > 0 ) {
            $(this).parent().remove(); //eliminar el campo
            iCnt= iCnt-1;
            diasEjecutables= diasEjecutables-1;
            if(diasEjecutables==0){
                document.getElementById('diasEjecucion').value=' ';
            }else {
                document.getElementById('diasEjecucion').value = diasEjecutables;

            }
        }

        if(iCnt==0){
            $(divSubmit).empty();
            $(divSubmit).remove();
            $(divValue).empty();
            $(divValue).remove();
            $('#btnDias').removeAttr('disabled');
        }
    });




});
