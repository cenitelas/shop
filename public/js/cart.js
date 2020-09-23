$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('a#add').click( function() {
        var product_id = $(this).data('id');
        var url = "/carts";

        $.ajax({
            type: "POST",
            url: url,
            data: { product_id: product_id },
            success: function (data) {
                if(data.status) {
                    let text = $('#cart').text();
                    $('#cart').parent().toggleClass("btn-outline-danger", 250)
                    setTimeout(() => {
                        $('#cart').parent().toggleClass("btn-outline-danger", 250)
                    }, 250)
                    $('#cart').text((parseInt(text) + 1) + " товаров");
                }else{
                    alert("Товар уже в корзине");
                }

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
