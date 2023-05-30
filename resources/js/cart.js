
(function($) {

    $('.item-quantity').on('change', function(e) {

        $.ajax({
            url: "/cart/" + $(this).data('id'), //data-id
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            },
            success: response => {
                console.log($(this).val());
            }
        });
    });

    $('.remove-item, .cart-items .shopping-item .remove-item').on('click', function(e) {

        let id = $(this).data('id');
        $.ajax({
            url: "/cart/" + id, //data-id
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: response => {
                $(`#${id}`).remove();
                $(`.cart-items .shopping-item .item${id}`).remove();
            }
        });
    });

    $('.add-to-cart').on('click', function(e) {

        $.ajax({
            url: "/cart",
            method: 'post',
            data: {
                product_id: $(this).data('id'),
                quantity: $(this).data('quantity'),
                _token: csrf_token
            },
            success: response => {
                alert('product added')
            }
        });
    });

})(jQuery);
