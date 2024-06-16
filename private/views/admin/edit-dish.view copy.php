<?php $this->view("admin/navigation") ?>
<div class="container  shadow mt-5 col-md-4 p-5 ">

    <h3 class="title">Edit Category</h3>
    <a href="<?= isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '#' ?>" class="btn btn-dark text-white mb-2">Back <i class="fas fa-backward"></i></a>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input name="name" value="<?= $dish->name ?>" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"><?= $dish->description ?></textarea>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Ingredients</label>
            <textarea name="ingredients" class="form-control" rows="3"><?= $dish->ingredients ?></textarea>
        </div>
        <select name="category" class="form-select">
            <option>Select the category</option>

            <?php foreach ($allCategories as $category) : ?>

                <?php $selected = ($category->id == $dish->category_id) ? 'selected' : ''; ?>

                <option <?= $selected ?> value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>
        <div id="preview"> <img id="cat_image" src="<?= UPLOADS ?><?= $dish->picture ?>" alt="your image" /></div>

        <label for="image_browser" class="btn-sm btn btn-success text-white  mt-2 mb-2 ">
            <input id="image_browser" type="file" name="image" class="btn btn-primary" style="display:none;">
            Browse Image<i class="fas fa-upload"></i></i>
        </label>
        <button type="submit" class="add_button">Edit</button>

    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#preview').show();

    $(document).ready(function() {
        $('#image_browser').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cat_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>