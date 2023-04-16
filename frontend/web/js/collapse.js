$(document).ready(function() {
    $('.collapse-opt').click(function() {
        var idAtr = $(this).attr('data-trigger');
        $('.collapse-opt').removeClass('active');
        $('.collapse-val').hide();
        $('#' + idAtr).show();
        $(this).addClass('active');
    });
});