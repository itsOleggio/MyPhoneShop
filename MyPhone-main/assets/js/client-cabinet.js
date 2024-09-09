import {
    changeColor,
    generateErrors,
    hide_areas,
    checkDateInputs
} from "./functions.js";

$(function () {
    let areas = [$('.show-orders-area'), $('.update-info-form')];

    $('.show-orders').on('click', function (e) {
        e.preventDefault();
        hide_areas(areas, '.show-orders-area');

        $('.show-orders-area').toggleClass('none');
    });

    $('.edit-info').on('click', function (e) {
        e.preventDefault();

        hide_areas(areas, '.update-info-form');

        $('.update-info-form').toggleClass('none');
    });

    $('.show-orders-form').on('submit', function (e) {
        e.preventDefault();
        $('.order_area').empty();

        let form = this;

        let ordersErrorsBlock = form.querySelector('.errors_block');
        let begin_date = form.querySelector('input[name="begin-date"]');
        let end_date = form.querySelector('input[name="end-date"]');

        checkDateInputs(begin_date, end_date, ordersErrorsBlock);

        if (ordersErrorsBlock.innerHTML == ''){
            let formData = new FormData();
            formData.append('begin-date', begin_date.value);
            formData.append('end-date', end_date.value);
            formData.append('client_action', 'show');

            $.ajax({
                url: '/assets/includes/profile-functions/client-actions.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (result) {
                    if (result.code == 'ok') {
                        for (let i = 0; i < result.orders.length; i++) {
                            let sum = 0;
                            let order_area = $('<div class="order"></div>').appendTo('.order_area');

                            let order = result.orders[i];

                            $('<div class="date_order">Заказ № ' + order.id + ' от ' + order.ordering_time + '</div>').appendTo(order_area);

                            let products = order.products;
                            if (products != undefined) {
                                for (let j = 0; j < products.length; j++) {
                                    let product_area = $('<a class="product_area" href="#"></a>').appendTo(order_area);
                                    $('<div class="container">' +
                                        '<img src="' + products[j].image + '" alt="Товар">' +
                                        '<div class="text title">' + products[j].name + '</div>' +
                                        '</div>').appendTo(product_area);
                                    $('<div class="container">' +
                                        '<div class="text">Количество: ' + products[j].count + ' штук</div>' +
                                        '<div class="text">Цена: ' + products[j].price * products[j].count + ' ₽</div>' +
                                        '</div>').appendTo(product_area);
                                    sum += products[j].price * products[j].count;
                                }
                            }

                            $('<div class="status_sum">' +
                                '<div class="status">Статус: ' + order.status + '</div>' +
                                '<div class="sum">Общая сумма: ' + sum + ' ₽</div>' +
                                '</div>').appendTo(order_area);
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

