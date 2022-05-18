$(document).ready(function() {
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
    $('.add-to-cart').click(function() {
        let pr_id = $(this).attr('id_pr');
        $.ajax({
            url: "http://127.0.0.1:8000/cart/addToCart",
            type: "post",
            data: {
                'pr_id': pr_id,
            },
            success: function(data) {
                if(data=='login')
                {
                    window.location.href = 'http://127.0.0.1:8000/login';
                }
                alert(data);
            },
        });
    });
    $('.remove-cart').on('click', function(){
        let pr_id = $(this).attr('pr_id');
        $.ajax({
            url: "http://127.0.0.1:8000/cart/deleteCart/"+pr_id,
            type: "delete",
            success: function(data) {
            },
        });
        $(this).closest('.row-product-cart').remove();

    })
    $('.number-product-cart').change(function(){
        let cart_id = $(this).attr('cart_id');
        let val = $(this).val();

        $.ajax({
            url: "get",
            data: {
                'number': val,
            },
            success: function(data) {
                alert(data);
            },
        });
    });
    $('.remove-product-cart').click(function(){
        let cart_id = $(this).attr('cart_id');
        $.ajax({
            url: "http://127.0.0.1:8000/cart/deleteCart/"+cart_id,
            type: "delete",
            success: function(data) {
            },
        });
        $(this).closest('.tr-cart').remove();
    })
});
