<?php $this->view("admin/navigation", ['title' => 'Add a new category']) ?>
<div class="container mx-auto shadow mt-5 ">
    <a class="btn btn-success float-end " href="category/add"><i class="fa fa-plus"></i> Add New</a>
    <br>
    <div class="card-group justify-content-center col-md-10 mt-5 mx-auto">
        <?php if (isset($allCategories) && count($allCategories) > 0) : ?>
            <h2 class="mb-5 mt-3">Categories</h2>

            <table class="table table-striped ">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($allCategories as $category) : ?>
                    <tr>
                        <td><img class="image" src="<?= UPLOADS ?>360_F_176331484_nLHY9EoW0ETwPZaS9OBXPGbCJhT70GZe.jpg"></td>
                        <td><?= $category->name ?></td>
                        <td><?= $category->description ?></td>
                        <td>
                            <a href="" class="btn btn-sm btn-success">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="/delete" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        <?php else : ?>
            <h4 class="m-5">No categories were added</h4>
        <?php endif; ?>
    </div>
</div>
<?php if (isset($errorMessage)) : ?>
    <div class="alert show error">
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

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const closeButtons = document.querySelectorAll('.close');

        closeButtons.forEach(closeButton => {
            closeButton.addEventListener('click', function() {
                const alert = this.parentElement;
                alert.style.display = 'none';
            });
        });
    });
</script>