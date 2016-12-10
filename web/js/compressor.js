function compress() {
    var compressed = $('#compressed');
    $.get({
        url:'/compress',
        dataType: 'json',
        data: {url: $('#url').val()}
    }).success(function(ret){
        $('#result').removeClass('hidden');
        compressed.val(ret.result);
        if(ret.success == true) {
            compressed.removeClass('alert-danger').addClass('alert-success');
        } else {
            compressed.removeClass('alert-success').addClass('alert-danger');
        }
    });
}

$(function() {
    $('#start').on('click', compress);
});