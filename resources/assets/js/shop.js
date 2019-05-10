function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}
// $('#shipping').change(function(){
//   $('#total').html(formatNumber(parseInt({{ Cart::subtotal() }})+ parseInt($('#shipping').val())));
// });
function addToCart(id, instance = null) {
    if (instance == null || instance == '') {
        var cart = $('.shopping-cart');
    } else {
        var cart = $('.shopping-' + instance);
    }
    var imgtodrag = $('.product-box-' + id).find("img").eq(0);
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
            .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
            .css({
                'opacity': '0.5',
                'position': 'absolute',
                'width': '150px',
                'z-index': '99999999'
            })
            .appendTo($('body'))
            .animate({
                'top': cart.offset().top,
                'left': cart.offset().left,
                'width': 75,
                'height': 75
            }, 1000, 'easeInOutExpo');
        // setTimeout(function () {
        //     cart.effect("shake", {times: 2}, 200);
        // }, 1500);

        imgclone.animate({
            'width': 0,
            'height': 0
        }, function() {
            $(this).detach()
        });
    }

    $.ajax({
        url: '/addToCart',
        type: 'POST',
        dataType: 'json',
        data: { id: id, instance: instance, _token: '{{ csrf_token() }}' },
        success: function(data) {
            console.log(data);
            flg = parseInt(data.flg);
            if (flg === 1) {
                setTimeout(function() {
                    if (data.instance == 'default') {
                        $('#count_cart').html(data.count_cart);
                        $('#cart-sidebar').html(data.htmlCart);
                        $('.subtotal').html(data.subtotal);
                        $('.top-subtotal').show();
                        $('.actions').show();
                    } else {
                        $('#count_' + data.instance).html(data.count_cart);
                    }

                }, 1000);
            } else {
                alert(data.error);
            }

        }
    });
}