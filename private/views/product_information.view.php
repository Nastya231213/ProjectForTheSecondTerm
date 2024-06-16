<?php $this->view("includes/navigation", ["title" => "Main"]) ?>



<div class="details_container p-5 m-5">
	<div class="row">
		<div class="col-md-6 border bg-white rounded">
			<div class="row">
				<div>
				<a href="<?=ROOT?>"><i class="fas fa-home fa-2x ml-3"></i></a> / <a href=""><?= $product->name ?></a>
				</div>
				<div class="row p-2">

					<div align="center" class="m-3">
						<img id="image_details" src="<?= UPLOADS . $product->picture ?>">
					</div>
					<div class="col  card p-4 mb-2">
						<h3>Characteristics</h3>
						<hr>
						<p class="mt-4">
							Name: <?= $product->name ?>
						</p>

						<div align="left">
							<p>Rating: <?= getRating($product->average_rating); ?>
							</p>
							<p>
								<?php if (isset($product->ingredients)) : ?>

									Ingredients: <?= $product->ingredients ?>
								<?php else : ?>
									Composition: <?= $product->composition ?>

								<?php endif; ?>
							</p>

							<p>
								Description: <?= $product->description ?>
							</p>
							<p>
								Price: <i class="fas fa-dollar-sign" style="color: black;"></i><?= $product->price ?></p>
						</div>
					</div>


				</div>
			</div>
		</div>
		<div class="col-md-6 text-center p-5 border bg-white rounded">
			<div class="row">
				<div class="col-md-4 text-success text-center p-2">
					<i class="fas fa-money-bill-wave success fa-4x "></i>
					<p>Cash On Delivery</p>
				</div>
				<div class="col-md-4  text-success text-center p-2">
					<i class="fas fa-undo-alt fa-4x success "></i>
					<p>Free
						Shipping</p>
				</div>
				<div class="col-md-4 text-success text-center p-2">
					<i class="fas fa-truck-moving success fa-4x "></i>
					<p>Free Shipping</p>
				</div>
			</div>
			<form method="POST" class="text-center">
				<input hidden name="idProduct" value="<?= $product->id ?>">

				<input type="submit" class="add_to_cart" value="Add to cart">
			</form>

		</div>
	</div>

</div>

<div class="container p-3">
	<div class="col-md-12 border bg-white rounded p-4 mb-3">


		<?php if (isset($product->composition)) {
			$addMode = "add_for_drink";
		} else {
			$addMode = "add_for_dishes";
		} ?>
		<div class="text-center ">
			<a href="<?= ROOT ?>/review/<?= $addMode ?>/<?= $product->id ?>" class="add_reviews text-white"><i class="fas fa-comment text-white"></i>Add Review</a>
		</div><br>
		<h2 class="text-center ">All the reviews to <?= $product->name ?> </h2>

		<hr>
		<?php if (isset($reviews) && count($reviews) > 0) : ?>
			<?php foreach ($reviews as $review) : ?>

				<div class="review">
					<div class="d-flex ">
						<h4 class="me-5"><?= $review->user_name ?></h4>
						<p class="rating mt-1">
							<?= getRating($review->rating) ?>
						</p>
					</div>
					<p><?= $review->comment ?></p>
				</div>
			<?php endforeach ?>
		<?php else : ?>
			<h5 class="text-center  mt-5">No reviews were found</h5>
		<?php endif; ?>
	</div>

</div>

<?php $this->view("includes/footer") ?>