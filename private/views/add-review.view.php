<?php $this->view("admin/navigation",['title'=>'Add review']) ?>
<div class="container  shadow mt-5 col-md-4 p-5 mb-5 ">
    <a href="<?= isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '#' ?>" class="btn btn-dark text-color">Back <i class="fas fa-backward"></i></a>

    <h3 class="title">Your review</h3>
    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
            <textarea name="comment" class="form-control" rows="3"></textarea>
        </div>

        <select name="rating" class="form-select">
            <option>Select the rating</option>
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <option value=<?= $i ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <button type="submit" class="add_button">Add</button>
    </form>
</div>
<?php $this->view("includes/footer") ?>