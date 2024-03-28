<?php $this->view("includes/navigation", ["title" => "Main"]) ?>
<h1 id="title">Prepared food</h1>

<div id="categories_container">
    <ul>
        <li><a href="#">All</a></li>
        <?php foreach (CATEGORIES as $category) : ?>
            <li><a href="#"><?= $category ?></a></li>

        <?php endforeach ?>
    </ul>

</div>
<div id="container">
    <div id="filters">
        <div class="input-group rounded">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <a href="" class="input-group-text border-0" id="search-addon">
                <i class="fas fa-search"></i>
            </a>
        </div>
        <h4 class="mt-5 md-3">Categories </h4>

        <?php foreach ($allCategories as $category) : ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="category<?= $category->id ?>" value="<?= $category->id ?>">
                <label class="form-check-label" for="category<?= $category->id ?>">
                    <?= $category->name ?>
                </label>
            </div>
        <?php endforeach; ?>
        <h4 class="mt-5 md-3">Price</h4>
        <span class="mt-2" id="priceOutput">$0 - $1000</span>

        <div class="mt-4">
            <label for="priceInput" class="form-label">Min:</label>
            <div class="col-6">
                <input type="number" class="form-control" id="priceInput" min="0" max="1000" step="10" value="0">
            </div>
            <div class="col-6">
                <label for="priceInput1" class="form-label1">Max:</label>
                <input type="number" class="form-control" id="priceInput1" min="0" max="1000" step="10" value="0">
            </div>
        </div>
        <a href="#" id="apply_button" class="btn ">Apply</a>


    </div>
    <div id="dishes">
        <?php foreach ($allDishes as $dish) : ?>
            <div class="card">

                <a href="" class="image_dish ">
                    <img src="<?= UPLOADS ?><?= $dish->picture ?>">
                </a>

                <div class="card_caption">
                    <p class="rating">
                        <i class="fas fa-star" style="color: #FFD43B;"></i>
                        <i class="fas fa-star" style="color: #FFD43B;"></i>
                        <i class="fas fa-star" style="color: #FFD43B;"></i>
                        <i class="fas fa-star" style="color: #FFD43B;"></i>
                        <i class="fas fa-star" style="color: #FFD43B;"></i>
                    </p>
                    <div class="name_dish">
                        <p><?= $dish->name ?></p>
                    </div>
                    <p class="price">$450</p>
                    <p class="discount"></p>

                </div>

                <button data-id="<?= $dish->id ?>" class="add_to_cart">Add to cart</button>
                <a href="" id="details">Details about the dish</a>

            </div>
            </a>
        <?php endforeach; ?>
    </div>
    <script>
        $(".add_to_cart").click(function(e) {
            e.preventDefault();

            var dishId = $(this).data("id");
            $.ajax({
                url: 'private\models\DishModel.php',
                type: 'POST',
                data: {
                    functionname: 'addToCart',
                    id: dishId
                },
                success: function(response) {
                    $("#cart").html(response);
                }
            });
        });
 

    </script>

</div>
</div>

<?php $this->view("includes/footer") ?>