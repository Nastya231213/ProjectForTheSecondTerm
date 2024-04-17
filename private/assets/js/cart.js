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
        $.ajax({
            url: 'private\core\helper_functions.php',
            type: 'GET',
            data: {
                functionname: 'decreaseAmount',
                id: dishId
            },
            success: function (response) {
                $("#body").html(response);
                bindEvents();
            }
        });
    });
    $(".plus").click(function (e) {
        e.preventDefault();

        var dishId = $(this).data("id");
        $.ajax({
            url: 'private\core\helper_functions.php',
            type: 'GET',
            data: {
                functionname: 'increaseAmount',
                id: dishId
            },
            success: function (response) {
                $("#body").html(response);
                bindEvents();

            }
        });
    });

    $(".delete").click(function(e) {
        e.preventDefault();
  
        var dishId = $(this).data("id");
        $.ajax({
          url: 'private\core\helper_functions.php',
          type: 'GET',
          data: {
            functionname: 'deleteProduct',
            id: dishId
          },
          success: function(response) {
            $("#body").html(response);
            bindEvents();
  
          }
        });
      });
});
