<?php $this->view("includes/navigation", ['title' => 'Your orders']) ?>
<br><br>
<div class="container mx-auto shadow mt-5 p-4">
    <a href="admin" class="btn btn-dark text-color">Back <i class="fas fa-backward"></i></a>

    <div class="card-group justify-content-center col-md-10 mt-5 mx-auto">
        <?php if (isset($yourOrders) && count($yourOrders) > 0) : ?>
            <h2 class="mb-5 mt-3">Your orders</h2>

            <table class="table table-striped ">
                <tr>
                    <th>Id</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Actions</th>

                </tr>
                <?php foreach ($yourOrders as $order) : ?>
                    <tr>
                        <td><?= $order->id ?></td>

                        <td><?= $order->city ?></td>
                        <td><?= $order->state ?></td>
                        <td><?= $order->address ?></td>
                        <td><?= $order->phone ?></td>
                        <td><?= $order->created_at ?></td>
                        <td><?php if ($order->status) : ?>
                                <p>Paid</p>
                            <?php else : ?>
                                <p>Unpaid</p>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (($order->form_payment != "Pay online" && !$order->status) || $order->status) : ?>
                                <p><?= $order->form_payment ?></p>
                            <?php else : ?>
                                <?php $paymentProccessor=new PaymentProcessor(PUBLIC_KEY,PRIVATE_KEY);
                                    $cart=new Cart();
                                    $paymentProccessor->processPayment($order->id,$cart->getTotalPrice());
                                ?>
                            <?php endif; ?>
                        </td>
                        <td>

                            <a id="deleteButton" href="dish/delete/<?= $order->id ?>" class="btn btn-sm btn-danger">
                                Cancel <i class="fas fa-window-close"></i>
                            </a>
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