import {
    changeColor,
    generateErrors,
    checkDateInputs
} from "./functions.js";

$(function () {


    $('.check-profit').on('click', function (e) {
        e.preventDefault();
        $('.order_area').empty();

        let form = $(this).closest('.rating-profit-form')[0];

        let ordersErrorsBlock = form.querySelector('.errors_block');
        let begin_date = form.querySelector('input[name="begin-date"]');
        let end_date = form.querySelector('input[name="end-date"]');

        checkDateInputs(begin_date, end_date, ordersErrorsBlock);

        if (ordersErrorsBlock.innerHTML == ''){
            let formData = new FormData();
            formData.append('begin-date', begin_date.value);
            formData.append('end-date', end_date.value);
            formData.append('owner_action', 'profit');

            $.ajax({
                url: '/assets/includes/profile-functions/owner_cabinet.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (result) {
                    if (result.code == 'ok') {
                        $('.grociers').empty();
                        console.log(result.total_price)
                        ordersErrorsBlock.innerHTML += '<p class="errors_block_good"> Прибыль: ' + result.total_price + ' ₽</p>';


                    } else {
                        ordersErrorsBlock.innerHTML += '<p class="errors_block_bad">' + result.message + '</p>';
                    }

                },
                error: function () {
                    console.log('Error!');
                }
            });
        }

    });

    $('.check-rating').on('click', function (e) {
        e.preventDefault();
        $('.order_area').empty();

        let form = $(this).closest('.rating-profit-form')[0];

        let ordersErrorsBlock = form.querySelector('.errors_block');
        let begin_date = form.querySelector('input[name="begin-date"]');
        let end_date = form.querySelector('input[name="end-date"]');

        checkDateInputs(begin_date, end_date, ordersErrorsBlock);

        if (ordersErrorsBlock.innerHTML == ''){
            let formData = new FormData();
            formData.append('begin-date', begin_date.value);
            formData.append('end-date', end_date.value);
            formData.append('owner_action', 'rating');

            $.ajax({
                url: '/assets/includes/profile-functions/owner_cabinet.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (result) {
                    if (result.code == 'ok') {
                        let order_area = $('<div class="order"></div>').appendTo('.order_area');

                        if (result.products != undefined) {
                            $('<h1>Рейтинг самых прибыльных товаров</h1>').appendTo(order_area);
                            for (let i = 0; i < result.products.length; i++) {
                                let product = result.products[i];
                                let product_area = $('<a class="product_area" href="#"></a>').appendTo(order_area);
                                $('<div class="container">' +
                                    '<img src="/assets/media/' + product.image + '" alt="Товар">' +
                                    '<div class="text title">' + product.name + '</div>' +
                                    '</div>').appendTo(product_area);
                                $('<div class="container">' +
                                    '<div class="text">Прибыль: ' + product.total_price + ' ₽</div>' +
                                    '</div>').appendTo(product_area);

                            }
                        }

                    } else {
                        ordersErrorsBlock.innerHTML += '<p class="errors_block_bad">' + result.message + '</p>';
                    }

                },
                error: function () {
                    console.log('Error!');
                }
            });
        }

    });
});