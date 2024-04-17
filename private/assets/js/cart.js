$(document).ready(function () {
    function bindEvents() {
        $(document).off('click', '.shopping');
        $(document).off('click', '.closeCart');

        $(document).on('click', '.shopping', function () {
            $('.container_cart').addClass('active');
        });

        $(document).on('click', '.closeCart', function () {
            $('.container_cart').removeClass('active');
        });
    }

    bindEvents();

    $(".minus").click(function (e) {
        e.preventDefault();

        var dishId = $(this).data("id");
        var listItem = $(this).closest("li");

        $.ajax({
            url: 'private\core\helper_functions.php',
            type: 'GET',
            data: {
                functionname: 'decreaseAmount',
                id: dishId
            },
            success: function (response) {
                var currentQuantity =parseInt(listItem.find("#currentQuantity").text());
                if (currentQuantity > 1) {
                    listItem .find("#currentQuantity").text(currentQuantity - 1);
                }
            }
        });
    });
    $(".plus").click(function (e) {
        e.preventDefault();

        var dishId = $(this).data("id");
        var listItem = $(this).closest("li");

        $.ajax({
            url: 'private\core\helper_functions.php',
            type: 'GET',
            data: {
                functionname: 'increaseAmount',
                id: dishId
            },
            success: function (response) {
                var currentQuantity =parseInt(listItem.find("#currentQuantity").text());
                listItem .find("#currentQuantity").text(currentQuantity + 1);
            }
        });

    });

    $(".delete").click(function (e) {
        e.preventDefault();

        var dishId = $(this).data("id");
        var listItem = $(this).closest("li");
        $.ajax({
            url: 'private\core\helper_functions.php',
            type: 'GET',
            data: {
                functionname: 'deleteProduct',
                id: dishId
            },
            success: function (response) {
                listItem.remove();
                bindEvents();
            }
        });
    });



});
