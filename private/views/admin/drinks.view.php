<?php $this->view("admin/navigation", ['title' => 'Drinks']) ?>
<br><br>
<div class="container mx-auto shadow mt-5 p-4 ">
    <a href="admin" class="btn btn-dark text-color">Back <i class="fas fa-backward"></i></a>

    <a class="btn btn-success float-end " href="drinks/add"><i class="fa fa-plus"></i> Add New</a>
    <br>
    <div class="card-group justify-content-center col-md-10 mt-5 mx-auto">
        <?php if (isset($allDrinks) && count($allDrinks) > 0) : ?>
            <h2 class="mb-5 mt-3">Drinks</h2>

            <table class="table table-striped ">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Volume</th>
                    <th>Composition</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($allDrinks as $drink) : ?>
                    <tr>
                        <td><img class="image" src="<?php echo UPLOADS . $drink->picture ?>"></td>
                        <td><?= $drink->name ?></td>
                        <td><?= $drink->category_name ?></td>
                        <td><?= $drink->volume ?></td>
                        <td><?= $drink->composition ?></td>
                        <td>
                            <div id="actions_buttons">
                                <a href="drinks/edit/<?= $drink->id ?>" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a id="deleteButton" href="drinks/delete/<?= $drink->id ?>" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
            <?php $pager->display();?>
        <?php else : ?>
            <h4 class="m-5">No drinks were added</h4>
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