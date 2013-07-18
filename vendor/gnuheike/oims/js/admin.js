var oims_loaded_url = null;

$(function() {
    $('body').delegate('table tr.product-grid-tr-trigger', 'click', function() {
        load_crud_product_form($(this).attr('data-update-url'));
    });

    $('#ma_quick_actions').next().find('a').click(multirowActions);

    $('#ImportForm-form').fileupload({
        done: function(e, data) {
            //Is there errors?
            if (typeof data.result[0].error !== 'undefined' && data.result[0].error !== null && data.result[0].error.length > 0) {
                  data.jqXHR.abort();
                //There is errors. Display errors messages
                $.each(data.result[0].error, function(i, val) {                    
                    noty_upload_error = noty({
                        text: val,
                        'layout': 'topRight',
                        template: '<div class=\"noty_message\"><span class=\"noty_text\"></span><div class=\"noty_close\"></div></div>',
                        closeWith: ['button'], // ['click', 'button', 'hover']                            
                        type: 'error',
                        callback: {
                            afterShow: function() {
                                setTimeout(function() {
                                    noty_upload_error.close();
                                }, 5000);
                            }
                        }
                    });
                });
            } else {
                //There is success message
                noty_upload = noty({
                    text: 'Upload Success.',
                    'layout': 'topRight',
                    template: '<div class=\"noty_message\"><span class=\"noty_text\"></span><div class=\"noty_close\"></div></div>',
                    closeWith: ['button'], // ['click', 'button', 'hover']                            
                    type: 'success',
                    callback: {
                        afterShow: function() {
                            setTimeout(function() {
                                noty_upload.close('noty_upload');
                            }, 3000);
                        }
                    }
                });

                document.location.reload(true);             
            }
        }});

});

function multirowActions() {
    var data = $(this).attr('data-modify').split('__');
    if (data.length < 1) {
        console.log('Unknown data-modify attribute. Must contain valid handler. ' + data.length);
        return false;
    }

    var checkboxes = jQuery('#inv-product-grid .checkbox-column :checkbox:checked[name!=inv-product-grid_c0_all]');
    if (checkboxes.length < 1) {
        noty({
            text: 'You have not selected any row.',
            'layout': 'topRight',
            type: 'alert'
        });
        return false;
    }

    var sendData = {
        'action': data[0],
        'params': {}
    };

    for (var j = 0; j < checkboxes.length; j++) {
        itemData = {};
        if (data.length > 2)
            for (var i = 1; i < data.length; i = i + 2)
                itemData[data[i]] = data[i + 1];
        else
            itemData = true;

        sendData['params'][jQuery(checkboxes[j]).val()] = itemData;
    }

    console.log(sendData);

    oims_toggle_multi_loader();
    var request = jQuery.ajax({
        'url': multirow_edit_url,
        'data': sendData,
        'type': 'post',
        'cache': false
    });

    request.complete(function() {
        oims_toggle_multi_loader();
    });

    request.success(function() {
        $.fn.yiiGridView.update('inv-product-grid');
        noty({
            text: 'Success',
            'layout': 'topRight',
            type: 'info'
        });
    });

    request.error(function(jqXHR) {
        noty({
            text: jqXHR.responseText,
            'layout': 'topRight',
            type: 'error'
        });
        console.log(jqXHR);
    });


    return true;
}

function load_crud_product_form(url) {
    if (url === oims_loaded_url)
        return false;
    else
        oims_loaded_url = url;


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
function oims_toggle_multi_loader() {
    $('#toolbarHandler .spin').toggle();
    $('#toolbarHandler .content').toggle();
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

function oims_aplly_filter(data) {
    var column = data[0];
    var value = data[1];
    $('.filter-container #InvProduct_' + column).val(value);
    $.fn.yiiGridView.update('inv-product-grid', {'data': 'InvProduct[' + column + ']=' + value});
}