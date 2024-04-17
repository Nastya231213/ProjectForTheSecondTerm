<?php $this->view("admin/navigation",['title'=>'Admin dashboard']) ?>

<h2 class="greetings">Hello, <?= $adminName ?></h2>
<div class="container p-3">
    <div class="row">
        <div class="col-md-3 ">
            <a href="dish">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-pizza-slice fa-4x"></i><br>
                        <h4>Dishes</h4>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-3 ">
            <a href="drinks">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-coffee fa-4x"></i><br>
                        <h4>Drinks</h4>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-money-check fa-4x"></i><br>
                        <h4>Orders</h4>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="review">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-share fa-4x"></i><br>
                        <h4>Reviews</h4>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-6 p-4">
            <a href="category">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-list-alt fa-4x"></i><br>
                        <h4>Categories</h4>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-6 p-4">
            <a href="">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas  fa-wrench fa-4x"></i><br>
                        <h4>Settings</h4>
                    </div>

                </div>
            </a>
        </div>
    </div>
</div>
<?php $this->view("includes/footer") ?>
