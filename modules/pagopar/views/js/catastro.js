
$('#pagoparAddCard').click(function (e) {
    $('.modal').removeClass('fade');
    $('.modal').toggleClass('is-visible');

    const url = $("#url_agregar_tarjeta").val() + "?action=1";

    xhr = $.ajax({
        type: 'POST',
        url: url,
        data: [],
        success: function(response) {
            const json = jQuery.parseJSON(response);
            if(json.respuesta === true) {
                const styles = {
                    'input-background-color' : '#ffffff',
                    'input-text-color': '#333333',
                    'input-border-color' : '#ffffff',
                    'input-placeholder-color' : '#333333',
                    'button-background-color' : '#5CB85C',
                    'button-text-color' : '#ffffff',
                    'button-border-color' : '#4CAE4C',
                    'form-background-color' : '#ffffff',
                    'form-border-color' : '#dddddd',
                    'header-background-color' : '#dddddd',
                    'header-text-color' : '#333333',
                    'hr-border-color' : '#dddddd'
                };
                $('.loader-1').css('display', 'none');

                Bancard.Cards.createForm('iframe-container', json.resultado, { styles: styles }, function(bancardJson) {
                    const url2 = $("#url_agregar_tarjeta").val() + "?action=3";
                    xhr = $.ajax({
                        type: 'POST',
                        url: url2,
                        data: [],
                        success: function(r) {
                            console.log(r);
                            location.reload();
                        },
                        error: function(code){
                            alert('Error al confirmar tarjeta');
                        }
                    });
                    if (bancardJson.message == 'add_new_card_fail')
                        alert(bancardJson.details);

                });
            }
        },
        error: function(code){
            alert('Ocurrio un error al tratar de agregar una tarjeta');
        }
    });

});

$(".modal-toggle").on("click", function(){
    $('.modal').toggleClass('is-visible');
});

$('.pagoparDeleteCard').click(function (e) {
    const url = $("#url_agregar_tarjeta").val() + "?action=2&hash_tarjeta="+e.target.id;
    xhr = $.ajax({
        type: 'POST',
        url: url,
        data: [],
        success: function(response) {
            const json = jQuery.parseJSON(response);
            if (json.respuesta === true){
                $("#"+e.target.id).remove();
            } else {
                alert(json.resultado);
            }
        },
        error: function(code){
            alert('Hubo un error al obtener las categorías. Recargue la página e intente nuevamente');
        }
    });
});