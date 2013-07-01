$(function() {
    $('body').delegate('table tr.product-grid-tr-trigger', 'dblclick', function() {
        load_crud_product_form($(this).attr('data-update-url'));
    });
});

function load_crud_product_form(url) {
    oims_toggle_loader();
    var request = jQuery.ajax({
        'url': url,
        'data': {},
        'type': 'post',
        'dataType': 'html',
        'cache': false
    });

    request.complete(function(jqXHR) {
        $('#oims-form .content').html(jqXHR.responseText);
        oims_toggle_loader();
    });

    request.success(function(data) {
    });

    request.error(function(jqXHR, textStatus) {
        console.log(jqXHR);
    });
}

function oims_toggle_loader() {
    $('#oims-form .spin').toggle();
    $('#oims-form .content').toggle();
}

function send_product_form() {
    var data = $("#inv-product-form").serialize();
    var url = $("#inv-product-form").attr('action');
    $.ajax({
        type: 'POST',
        'url': url,
        data: data,
        success: function(data) {
            $('#oims-form .content').html(data);
            $.fn.yiiGridView.update('inv-product-grid');
        },
        error: function(data) { // if error occured
            alert("Error occured.please try again");
            alert(data);
        },
        dataType: 'html'
    });

}