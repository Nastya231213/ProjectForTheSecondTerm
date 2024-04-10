<?php $this->view("includes/navigation", ["title" => "Main"]) ?>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://citatnica.ru/wp-content/uploads/2021/06/9d170b6bf4f7096ee71ecdd78607f6ec.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://www.southernliving.com/thmb/3x3cJaiOvQ8-3YxtMQX0vvh1hQw=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/2652401_QFSSL_SupremePizza_00072-d910a935ba7d448e8c7545a963ed7101.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://nutricia.com.au/fortisip/wp-content/uploads/sites/8/2020/09/Forticreme-Chocolate-Chocolate-Layered-Dessert-1-scaled.jpeg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
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
    <?php if (isset($allDishes) && count($allDishes) > 0) : ?>

        <div id="dishes">
            <?php foreach ($allDishes as $dish) : ?>
                <form method="POST">
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
                            <h4>$<?= $dish->price ?></h4>
                            <p class="discount"></p>

                        </div>
                        <input name="idDish" hidden value="<?= $dish->id ?>">

                        <input type="submit" class="add_to_cart" value="Add to cart">
                        <a href="dish/details/<?= $dish->id ?>" id="details">Details about the dish</a>

                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h2>Not dishes found</h2>
    <?php endif; ?>



</div>
</div>

<?php $this->view("includes/footer") ?>