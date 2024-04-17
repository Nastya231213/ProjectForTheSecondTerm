<?php $this->view("admin/navigation", ['title' => 'Dishes']) ?>
<br><br>
<div class="container mx-auto shadow mt-5 p-4">
    <a href="admin" class="btn btn-dark text-color">Back <i class="fas fa-backward"></i></a>

    <a class="btn btn-success float-end " href="dish/add"><i class="fa fa-plus"></i> Add New</a>
    <br>

    <div class="card-group justify-content-center col-md-10 mt-5 mx-auto">
        <?php if (isset($allDishes) && count($allDishes) > 0) : ?>
            <h2 class="mb-5 mt-3">Dishes</h2>

            <table class="table table-striped ">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>

                    <th>Description</th>
                    <th>Intredients</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($allDishes as $dish) : ?>
                    <tr>
                        <td><img class="image" src="<?php echo UPLOADS . $dish->picture ?>"></td>
                        <td><?= $dish->name ?></td>
                        <td><?= $dish->category_name ?></td>
                        <td><?= $dish->description ?></td>
                        <td><?= $dish->ingredients ?></td>

                        <td>
                            <div id="actions_buttons">
                                <a href="dish/edit/<?= $dish->id ?>" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a id="deleteButton" href="dish/delete/<?= $dish->id ?>" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        <?php else : ?>
            <h4 class="m-5">No dishes were added</h4>
        <?php endif; ?>
    </div>
</div>
<?php if (isset($errorMessage)) : ?>
    <div class="alert show ">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg"><?= $errorMessage ?></span>
        <span class="close">
            <span class="fas fa-times"></span>
        </span>
    </div>
<?php endif; ?>

<?php if (isset($successMessage)) : ?>
    <div class="alert_success show ">
        <span class="fas fa-check-circle"></span>
        <span class="msg"><?= $successMessage ?></span>
        <span class="close">
            <span class="fas fa-times"></span>
        </span>
    </div>
<?php endif; ?>

<script defer src="<?= ASSETS ?>/js/confirmation.js"></script>
<?php $this->view("includes/footer") ?>