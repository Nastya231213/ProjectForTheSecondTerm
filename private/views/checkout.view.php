<?php $this->view("includes/navigation", ["title" => "Checkout"]) ?>


<div class=" container col-md-5 ">
    <div class=" card p-5">
    <div class="card-body">
        <h2 class="text-center text-success" >Your details for
            order</h2>
        <form action="order/add" method="post">
            <input type="hidden" name="id" value="">
            <div class="row">
                <div class="form-group col-md-6 ">
                    <label for="inputEmail4">Full name</label> <input type="text" required value="" class="form-control" id="inputEmail4" name="fullName">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Email</label> <input type="email" name="email" class="form-control" id="inputPassword4" value="">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Phone Number</label> <input name="phoneNum" type="text" class="form-control" id="inputEmail4" value="">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Address</label> <input name="address" class="form-control" id="inputPassword4" value="" type="text">
                </div>
            </div>
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="inputPassword4">City</label> <input name="city" class="form-control" id="inputPassword4" type="text">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputEmail4">State</label> <input type="text" name="state" class="form-control" id="inputEmail4">
                </div>
            </div>

            <div class="form-group">
                <label>Payment Model</label> 
                <select class="form-control" name="formPayment">
                    <option>--Select--</option>
                    <option value="Pay on delivery">Pay on delivery</option>
                    <option value="Pay online">Pay Online</option>

                </select>
            </div>
            <div class="text-center ">
                <button class="btn btn-success">Order Now</button>
                <a href="<?=ROOT?>" class="btn btn-light">Continue
                    Shopping</a>
            </div>

        </form>
    </div>
</div>
</div>
<?php $this->view("includes/footer") ?>