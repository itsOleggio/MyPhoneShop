

$(function () {
    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();
        alert('Товар добавлен!');

        let id = $(this).data('id');
        let parent = $(this).closest('.product_area');

    $.ajax({
        url: '/assets/includes/cart-objects.php',
        type: 'GET',
        data: {cart: 'add', id: id},
        dataType: 'json',
        success: function (result) {
            if (result.code == 'ok') {
                $('#cart-num').text(result.total_count);

                $('#count-'+id).text(result.count);
                let cost = $(parent).find('.cart_cost_container');

                if (parent != undefined) {
                    $('.count').text('Всего товаров: ' + result.total_count);
                    $('.sum').text('Общая сумма: ' + result.total_sum + ' ₽');
                    $(cost).text('Цена: ' + result.product.price * result.count + ' ₽');
                }


            } else {
                alert(result.product);
            }

        },
        error: function () {
            console.log('Error!');
        }
    });
});

$('.del-from-cart').on('click', function (e) {
    e.preventDefault();

    let id = $(this).data('id');
    let parent = $(this).closest('.product_area');

    $.ajax({
        url: '/assets/includes/cart-objects.php',
        type: 'GET',
        data: {cart: 'delete', id: id},
        dataType: 'json',
        success: function (result) {
            if (result.code == 'ok') {
                $('#cart-num').text(result.total_count);
                $('#count-'+id).text(result.count);

                let cost = $(parent).find('.cart_cost_container');

                if (parent != undefined) {
                    $('.count').text('Всего товаров: ' + result.total_count);
                    $('.sum').text('Общая сумма: ' + result.total_sum + ' ₽');
                    $(cost).text('Цена: ' + result.product.price * result.count + ' ₽');
                }

                if (cost != undefined) {
                    $(cost).text('Цена: ' + result.product.price * result.count + ' ₽')
                    if (result.count == 0) {
                        $(parent).remove();
                    }
                }

            } else {
                alert(result.answer);
            }

        },
        error: function () {
            console.log('Error!');
        }
    });
});

$('.checkout').on('click', function (e) {
    e.preventDefault();

    let parent = $(this).closest('.order');

    $.ajax({
        url: '/assets/includes/cart-objects.php',
        type: 'POST',
        data: {cart: 'checkout'},
        dataType: 'json',
        success: function (result) {
            if (result.code == 'ok') {
                $(parent).remove();
                $('#cart-num').text('0');
                $('<div>Заказ №' + result.answer + ' добавлен на обработку!</div><br><a href="../../index.php">На главную</a>').appendTo('.cart_area')
                // setTimeout(window.location.href = "../../index.php", 100);
            } else {
                alert(result.answer);
            }

        },
        error: function () {
            console.log('Error!');
        }
    });
});
});