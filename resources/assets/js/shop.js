$(function() {
    $('#shipping').change(function(){
        var subtotal = parseInt($('.price .subtotal').html());
        var shipping = $('#shipping').val();
        $('#total').html(formatNumber(subtotal)+ parseInt(shipping));
    });
});

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}
