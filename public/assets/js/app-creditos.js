/* -- Routes -- */
/*var routes = {
  inscriptions     : '/dashboard/json/inscriptions/',
};*/

/* -- App -- */
var filtro_fecha_inicio = $("#fecha_inicio");


if($(".items").length){
    listInscriptions('-');
}

filtro_fecha_inicio.change(function(){
  listInscriptions($(this).val());
});

/* Edit Inscription */


if($("#id_enrollment").val()){

    // Muestra detalle de la forma de pago
    showPaymentMethodStudent($("#id_enrollment").val());

    showEnrollmentBillingClient($("#id_enrollment").val());
}


/* -- Form Inscription -- */

// Selección de medio de pago
$("#id_payment_method").change(function(){

    var c = $(this).val() * 1;

    if(c){

        $(".content_item").hide();
        $(".content_item_"+c).show();
        $(".content_item_mount").show();


        $("#amount").removeAttr("readonly");

        if(c == 3) {
            $("#amount").attr("readonly", "readonly");
        } else if(c == 4){
            $(".content_item_mount").hide();
            $(".content_concept").hide();
        }

        //showConcepts(c, $("#id_enrollment").val());

    } else {

        $(".content_item").hide();

    }




});


// Calculo dinamico de montos segun el medio de pago condicional
$( "#condicional_amount_1" ).keyup(function() {
    var amount = $("#amount");
    amount.val(calculateAmmountCondicional($(this).val() * 1 , $( "#condicional_amount_2" ).val() * 1 ) );
});

$( "#condicional_amount_2" ).keyup(function() {
    var amount = $("#amount");
    amount.val(calculateAmmountCondicional($(this).val() * 1, $( "#condicional_amount_1" ).val() * 1) );
});

// Concepto
$( "input[name='amount']" ).keyup(function() {

    /*var amount = $(this);
    var calculate_amount = calculateAmmountCondicional($(this).val() * 1, $( "#condicional_amount_1" ).val() * 1);
    amount.val(calculate_amount);*/

    var amount = $(this);
    // Pago Total
    if($(".concept_amount").hasClass("amount_9_1") ){
        $(".amount_9_1").val(amount.val());

    // Pago Fraccionado
    } else if( $(".concept_amount").hasClass("amount_3_2") ){
        $(".amount_3_2").val(amount.val());

    // Pago Condicional
    } else if( $(".concept_amount").hasClass("amount_3_3") ){
        $(".amount_3_3").val(amount.val());
    }

});

$("#frm_edit_enrollment_payment_concept").find(".save").click(function(){

    event.preventDefault();

    $.ajax({
        url:'/dashboard/creditos/update_pagos/store',
        type:'post',
        datatype: 'json',
        data: $( "#frm_edit_enrollment_payment_concept" ).serialize(),
        beforeSend: function(){

            $("#frm_edit_enrollment_payment_concept").find(".save").attr("disabled", "disabled");
        },
        success:function(response)
        {
            $(".message").html(response.message);
        },
        complete: function(){
            $("#frm_edit_enrollment_payment_concept").find(".alert-success").show().removeClass("out").addClass("in");
            $("#frm_edit_enrollment_payment_concept").find(".save").removeAttr("disabled");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    });

});


$("#frm_billing_client").find(".save").click(function(){

    event.preventDefault();

    $.ajax({
        url:'/hsqegroup/api/inscription/billing_client/store',
        type:'post',
        datatype: 'json',
        data: $( "#frm_billing_client" ).serialize()+"&id_enrollment="+$("#id_enrollment").val(),
        beforeSend: function(){
            $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
        },
        success:function(response)
        {
            $(".message").html(response.message);
        },
        complete: function(){
            $("#frm_billing_client").find(".alert-success").show().removeClass("out").addClass("in");
            $("#frm_billing_client").find(".save").removeAttr("disabled");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_billing_client").find(".save").attr("disabled", "disabled");
            }
        }
    });

});

/* -- Customs Functions --*/

/*
* Enrollments Lists
*/
function listInscriptions(fecha_inicio){
  $.ajax({
     url:'/dashboard/json/inscriptions/'+fecha_inicio,
     type:'get',
     datatype: 'json',
     data:{},
     beforeSend: function(){
       GridbeforeSend();
     },
     success:function(response)
     {
        GridSuccess(response);
        console.log(response);
     },
     error:function(response)
    {
      if(  response.status == 400){
        GridError(response);
      }
    }
  }).done(function(data){
    if (! $.fn.dataTable.isDataTable( '#datatable-responsive' ) ) {
      $('#datatable-responsive').DataTable({
          destroy: true,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "order": [[ 1, "desc" ]],
          "language":
          {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Sin resultados",
            "info": "Mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros Activos",
            "infoFiltered": "(filtrada de _MAX_  entradas en total)",
            "sSearch": "Buscar :",
            "paginate": {
              "previous": "Anterior",
              "next": "Siguiente",
              "first": "Inicio",
              "last": "Final"
            }
          },
          dom: "Bfrtip",
          buttons: [
            {
              extend: "excel",
              className: "btn btn-5 btn-5a icon-excel excel"
            }, {
              extend: "pdf",
              className: "btn btn-5 btn-5a icon-pdf pdf"
            }, {
              extend: "print",
              text:"Imprimir",
              className: "btn btn-5 btn-5a icon-print print"
            }],
          });
    }

    });
}

// Medio de Pago
function showPaymentMethodStudent(id_enrollment){
    $.ajax({
        url:'/hsqegroup/api/student/'+id_enrollment+'/payment-method/show',
        type:'get',
        datatype: 'json',
        data: {},
        beforeSend: function(){

        },
        success:function(response)
        {

            $("#id_payment_method").val(response.id_payment_method).trigger("change");
            $("#amount").val(response.amount);
            $("#observation").val(response.observation);

            // Fraccionado
            if(response.id_payment_method == 2){
                
                $("#num_cuota").val(response.fraccionado.num_cuota).trigger("change");

            // Condicional
            } else if (response.id_payment_method == 3) {

                $.each( response.condicional, function(i, item) {
                    $("#condicional_date_"+item.num_cuota).val(item.date);
                    $("#condicional_amount_"+item.num_cuota).val(item.amount);
                });
                
            }

        },
        complete: function(){

            showConcepts(id_enrollment);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    });
}

// Conceptos
function showConcepts(id_enrollment){
    $.ajax({
        url:'/hsqegroup/api/inscription/'+id_enrollment+'/concepts/show',
        type:'get',
        datatype: 'json',
        data: {},
        beforeSend: function(){

        },
        success:function(response)
        {

            var source   = $("#response-template-concepts").html();
            var template = Handlebars.compile(source);
            var html    = template(response);
            $(".content_concept_items").empty().append(html);

            $.each( response.response, function(i, item) {
                console.log(item);
                if(item.active == 1){
                    $("#checked_"+item.id).attr("checked", "checked");
                }

            });


            $(".content_concept").show();
            console.log(response);

        },
        complete: function(){

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(response);
            /*if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }*/
        }
    });

}

// Datos de la facturación
function showEnrollmentBillingClient(id_enrollment){
    $.ajax({
        url:'/hsqegroup/api/inscription/'+id_enrollment+'/billing_client/show',
        type:'get',
        datatype: 'json',
        data: {},
        beforeSend: function(){

        },
        success:function(response)
        {

            console.log(response);

            $("#billing_razon_social").val(response.razon_social);
            $("#billing_ruc").val(response.ruc);
            $("#billing_address").val(response.address);
            $("#billing_phone").val(response.phone);
            $("#billing_client_firstname").val(response.client_firstname);
            $("#billing_client_lastname").val(response.client_lastname);

        },
        complete: function(){

        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                //$("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    });
}

function calculateAmmountCondicional(amount1, amount2){

    var calcular = (amount1 + amount2);


    if( $(".concept_amount").hasClass("amount_3_3") ){
        $(".amount_3_3").val(calcular);
    }

    return calcular;
}
