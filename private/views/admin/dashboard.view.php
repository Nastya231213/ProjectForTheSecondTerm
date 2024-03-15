<?php $this->view("admin/navigation") ?>

<h2 class="greetings">Hello, <?= $adminName ?></h2>
<div class="container p-3">
    <div class="row">
        <div class="col-md-3 ">
            <a href="product">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-shopping-basket fa-4x"></i><br>
                        <h4>Products</h4>
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
            <a href="">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-user-tag fa-4x"></i><br>
                        <h4>Customers</h4>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas  fa-percent fa-4x"></i><br>
                        <h4>Discounts</h4>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-md-3 p-4">
            <a href="">
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