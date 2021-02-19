$(document).ready(function () { /*esconde los campos de razon social y ruc*/
    $("#facturasDatos").hide();
    var $variable = getUrlVars()["x"];
    var $variable_z = getUrlVars()["z"];
    if ($variable == 'vacio') {
        alert('Complete los campos: Cédula o Documento');
        $("#num_documento").focus();
    } else if ($variable_z == 'vacio') {
        alert('Complete los campos: Ruc o Razón Social');
        $("#num_documento").focus();
    }
    moveFooter();
    $(".pagopar-methods .list .more").click(function(){
        $(".pagopar-methods .list .extra-method").toggleClass('hidden');
        $(".pagopar-methods .list .more").toggleClass('active');
    });
});


$("#num_documento").keyup(function() {
    $("#num_documento").val($("#num_documento").val());
    $("#payment-confirmation > div > button").removeAttr('disabled');
    var $url = $("#url_recibir_ajax").val();
    var $docu = $("#num_documento").val();
    var $razon = $("#razon_social").val();
    var $ruc = $("#ruc").val();
    var $pasarela = $('input[name=pasarela]:checked').val();
    var $factura = $('#factura').is(":checked");

    /* Si el campo utilizado por pagopar es visible, es porque se selecciono el medio de pago Pagopar y hay que aplicar el control */
    if ($("#num_documento").is(":visible")) {
        
        $.post($url+"?num_documento="+$docu+"&razon_social="+$razon+"&ruc="+$ruc+"&pasarela="+$pasarela+"&factura="+$factura,
            function (data, status) {

                if (status == 'success') {
                    console.log('pagopar ajax: ' + status + ' - ' + data);
                } else {
                    console.log('pagopar ajax: ' + status);
                }
            });
    }

});

$("#razon_social").keyup(function() {
    $("#num_documento").val($("#num_documento").val());
    var $url = $("#url_recibir_ajax").val();
    var $docu = $("#num_documento").val();
    var $razon = $("#razon_social").val();
    var $ruc = $("#ruc").val();
    var $pasarela = $('input[name=pasarela]:checked').val();
    var $factura = $('#factura').is(":checked");

    /* Si el campo utilizado por pagopar es visible, es porque se selecciono el medio de pago Pagopar y hay que aplicar el control */
    if ($("#razon_social").is(":visible")) {
        $("#payment-confirmation > div > button").removeAttr('disabled');
        $.post($url+"?num_documento="+$docu+"&razon_social="+$razon+"&ruc="+$ruc+"&pasarela="+$pasarela+"&factura="+$factura,
            function (data, status) {

                if (status == 'success') {
                    console.log('pagopar ajax: ' + status + ' - ' + data);
                } else {
                    console.log('pagopar ajax: ' + status);
                }
            });
    }

});

$("#ruc").keyup(function() {
    $("#num_documento").val($("#num_documento").val());
    var $url = $("#url_recibir_ajax").val();
    var $docu = $("#num_documento").val();
    var $razon = $("#razon_social").val();
    var $ruc = $("#ruc").val();
    var $pasarela = $('input[name=pasarela]:checked').val();
    var $factura = $('#factura').is(":checked");

    /* Si el campo utilizado por pagopar es visible, es porque se selecciono el medio de pago Pagopar y hay que aplicar el control */
    if ($("#ruc").is(":visible")) {
        $("#payment-confirmation > div > button").removeAttr('disabled');
        $.post($url+"?num_documento="+$docu+"&razon_social="+$razon+"&ruc="+$ruc+"&pasarela="+$pasarela+"&factura="+$factura,
            function (data, status) {

                if (status == 'success') {
                    console.log('pagopar ajax: ' + status + ' - ' + data);
                } else {
                    console.log('pagopar ajax: ' + status);
                }
            });
    }

});

$('input[name=pasarela]').on('click change', function(e) {
    $("#num_documento").val($("#num_documento").val());
    var $url = $("#url_recibir_ajax").val();
    var $docu = $("#num_documento").val();
    var $razon = $("#razon_social").val();
    var $ruc = $("#ruc").val();
    var $pasarela = $('input[name=pasarela]:checked').val();
    var $factura = $('#factura').is(":checked");

    /* Si el campo utilizado por pagopar es visible, es porque se selecciono el medio de pago Pagopar y hay que aplicar el control */
    if ($("#num_documento").is(":visible")) {

        $.post($url+"?num_documento="+$docu+"&razon_social="+$razon+"&ruc="+$ruc+"&pasarela="+$pasarela+"&factura="+$factura,
            function (data, status) {

                if (status == 'success') {
                    console.log('pagopar ajax: ' + status + ' - ' + data);
                } else {
                    console.log('pagopar ajax: ' + status);
                }
            });
    }
});

function moveFooter() {
    const r = document.getElementsByClassName("footerPagopar");
    const pagopar = r[0];
    r[0].parentNode.removeChild(r[0]);
    var d = document.getElementsByTagName("footer");
    $( "#footer" ).after(pagopar);
}

$('form').submit(function () {

    /* Si el campo utilizado por pagopar es visible, es porque se selecciono el medio de pago Pagopar y hay que aplicar el control */
    if ($("#num_documento").is(":visible")) {


        $mensaje = 'Es necesario completar el campo';
        var $docu = $("#num_documento").val();
        var $razon = $("#razon_social").val();
        var $ruc = $("#ruc").val();

        if ($docu.length == 0) {
            alert($mensaje);
            $("#num_documento").css({"border-color": "red",
                "border-weight": "2px",
                "border-style": "solid"});
            $("#num_documento").focus();
            return false;
        } else if ($('#factura').is(":checked")) {

            if ($razon.length == 0) {

                alert($mensaje);
                $("#razon_social").css({"border-color": "red",
                    "border-weight": "2px",
                    "border-style": "solid"});
                $("#razon_social").focus();

                return false;

            } else if ($ruc.length == 0) {

                alert($mensaje);
                $("#ruc").css({"border-color": "red",
                    "border-weight": "2px",
                    "border-style": "solid"});
                $("#ruc").focus();

                return false;

            }

        } else {
            return true;
        }

    }



});

$("#factura").click(function (e) {/*muestra o esconde campos adicionales de factura */

    if ($('#factura').is(":checked"))
    {
        $("#factura").val(true);
    } else {
        $("#factura").val(false);
    }
    
    $('#facturasDatos').toggle();
});



$(":button").click(function (e) { /*envia datos para confirmar compra*/

    var $url = $("#url_recibir_ajax").val();
    var $docu = $("#num_documento").val();
    var $razon = $("#razon_social").val();
    var $ruc = $("#ruc").val();
    var $pasarela = $('input[name=pasarela]:checked').val();
    var $factura = $('#factura').is(":checked");

    /* Si el campo utilizado por pagopar es visible, es porque se selecciono el medio de pago Pagopar y hay que aplicar el control */
    if ($("#num_documento").is(":visible")) {

        $.post($url+"?num_documento="+$docu+"&razon_social="+$razon+"&ruc="+$ruc+"&pasarela="+$pasarela+"&factura="+$factura,
        function (data, status) {

            if (status == 'success') {
                console.log('pagopar ajax: ' + status + ' - ' + data);
            } else {
                console.log('pagopar ajax: ' + status);
            }
        });
    }



});

$("#supercheckout_confirm_order").click(function (e) {/*envia datos para confirmar compra en supercheckout*/

    var $url = $("#url_recibir_ajax").val();
    var $docu = $("#num_documento").val();
    var $razon = $("#razon_social").val();
    var $tipoDocu = $("#tipo_documento").val();
    var $pasarela = $('input[name=pasarela]:checked').val();

    /* Si el campo utilizado por pagopar es visible, es porque se selecciono el medio de pago Pagopar y hay que aplicar el control */
    if ($("#num_documento").is(":visible")) {


        if ($docu.length == 0 || $razon.length == 0 || $tipoDocu.length == 0) {

            alert("Complete los datos para continuar con su compra");
            $("#num_documento").focus();
            $("#num_documento").attr("required", "true");

            $(":button").prop("disabled", true);


        } else {

            $.post($url+"?num_documento="+$docu+"&razon_social="+$razon+"&ruc="+$ruc+"&pasarela="+$pasarela+"&facture="+$factura,
            function (data, status) {

                if (status == 'success') {
                    console.log('pagopar ajax: ' + status + ' - ' + data);
                } else {
                    console.log('pagopar ajax: ' + status);
                }
            });

        }
    }
});


/*funcion get*/
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}