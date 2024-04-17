<?php $this->view("admin/navigation", ['title' => 'Reviews']) ?>
<div class="container mx-auto shadow mt-5 ">
    <a class="btn btn-success float-end " href="dish/add"><i class="fa fa-plus"></i> Add New</a>
    <br>
    <div class="card-group justify-content-center col-md-10 mt-5 mx-auto">
        <?php if (isset($allReviews) && count($allReviews) > 0) : ?>
            <h2 class="mb-5 mt-3">Reviews</h2>

            <table class="table table-striped ">
                <tr>
                    <th>Id</th>
                    <th>Rating</th>
                    <th>Author</th>

                    <th>Comment</th>
                    <th>Date</th>
                    <th>Actions</th>

                </tr>
                <?php foreach ($allReviews as $review) : ?>
                    <tr>
                        <td><?= $review->id ?></td>
                        <td><?= $review->rating ?></td>
                        <td><?= $review->user_name ?></td>
                        <td><?= $review->comment ?></td>
                        <td><?= $review->created_at ?></td>

                        <td>
                            <div id="actions_buttons">
                           
                                <a id="deleteButton" href="review/delete/<?= $review->id ?>" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        <?php else : ?>
            <h4 class="m-5">No reviews were added</h4>
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