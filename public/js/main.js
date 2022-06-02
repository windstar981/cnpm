$(document).ready(function() {
    let domain = 'http://127.0.0.1:8000/';
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
            url: domain+"cart/addToCart",
            type: "post",
            data: {
                'pr_id': pr_id,
                'number' :1,
            },
            success: function(data) {
                if(data=='login')
                {
                    window.location.href = domain+'login';
                }
                alert(data);
            },
        });
    });
    $('.add-cart').click(function() {
        let pr_id = $(this).attr('id_pr');
        let number = $('.number-product').val();
        console.log(pr_id);
        console.log(number);
        $.ajax({
            url: domain+"cart/addToCart",
            type: "post",
            data: {
                'pr_id': pr_id,
                'number' :number,
            },
            success: function(data) {
                if(data=='login')
                {
                    window.location.href = domain+'login';
                }
                alert(data);
            },
        });
    });
    $('.remove-cart').on('click', function(){
        let pr_id = $(this).attr('pr_id');
        $.ajax({
            url: domain+"cart/deleteCart/"+pr_id,
            type: "delete",
            success: function(data) {
            },
        });
        $(this).closest('.row-product-cart').remove();

    })
    $('.number-product-cart').change(function(){
        let cart_id = $(this).attr('cart_id');
        let val = $(this).val();
        alert(val);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PATCH",
            url: domain+"updateCart",
            data: {
                'number': val,
                'cart_id':cart_id,
            },
            success: function(data) {
                alert(data);
            },
        });
    });
    $('.remove-product-cart').click(function(){
        let cart_id = $(this).attr('cart_id');
        $.ajax({
            url: domain+"cart/deleteCart/"+cart_id,
            type: "delete",
            success: function(data) {
            },
        });
        $(this).closest('.tr-cart').remove();
    })
    $('.checkout').click(function() {
        let name = $('#name').val();
        let email = $('#email').val();
        let add = $('#address').val();
        let telephone = $('#telephone').val();
        let total = $('.total').html();
        // console.log(name);
        // console.log(email);
        // console.log(add);
        // console.log(telephone);
        // console.log(total);
        $.ajax({
            url: domain+"saveOrder",
            type: "POST",
            data: {
                'name':name,
                'email' :email,
                'add':add,
                'telephone':telephone,
                'total':total
            },
            success: function(data) {
                alert(data);
            },
        });
    });
});
