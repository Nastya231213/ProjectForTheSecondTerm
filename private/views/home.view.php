<?php $this->view("includes/navigation", ["title" => "Main"]) ?>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://zira.uz/wp-content/uploads/2018/04/magnoliya-1.jpg" class="d-block w-100" alt="...">
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

<h1 class="mt-3 text-center">Categories of food :</h1>

<div id="container">
 
    <?php if (isset($allCategoriesDishes) && count($allCategoriesDishes) > 0) : ?>

        <div id="categories">
            <?php foreach ($allCategoriesDishes as $category) : ?>
                <form method="POST">
                    <div class="card">

                        <a href="" class="image ">
                            <img src="<?= UPLOADS ?><?= $category->picture ?>">
                        </a>

                        
                                <h1><?= $category->name ?></h1>



                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h2>Not categories found</h2>
    <?php endif; ?>



</div>
<h1 class="mt-3 text-center">Categories of drinks :</h1>

<div id="container">
 
    <?php if (isset($allCategoriesDrinks) && count($allCategoriesDrinks) > 0) : ?>

        <div id="categories">
            <?php foreach ($allCategoriesDrinks as $category) : ?>
                <form method="POST">
                    <div class="card">

                        <a href="" class="image ">
                            <img src="<?= UPLOADS ?><?= $category->picture ?>">
                        </a>

                        
                                <h1><?= $category->name ?></h1>



                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h2>Not categories found</h2>
    <?php endif; ?>



</div>
</div>

<?php $this->view("includes/footer") ?>