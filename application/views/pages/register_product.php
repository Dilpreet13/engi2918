<div class="container">
    <div class="jumbotron">
        <h1 class="display-3">Register your product</h1>
        <p class="lead">Before you can list your product on the platform, you must register it.</p>
    </div>

    <div class="row">
        <div class="col-10">

            <form action="<?php echo site_url("Products/register") ;?>" method="POST">
                <div class="form-group">
                    <label for="name_input">Product Name:</label>
                    <input type="text" name = "pname" class="form-control" id="name_input" placeholder="1970 Dodge Charger">
                </div>
                <div class="form-group">
                    <label for="desc_input">Description:</label>
                    <input type="text" name = "desc" class="form-control" id="desc_input" placeholder="Description">
                </div>
                <div class="form-group">
                    <label for="desc_input">Starting Price:</label>
                    <input type="text" name = "start_price" class="form-control" id="desc_input" placeholder="$0000.00">
                </div>
                <div class="form-group">
                    <label for="desc_input">Minimum Price:</label>
                    <input type="text" name = "min_price" class="form-control" id="desc_input" placeholder="$0000.00">
                </div>
                <div class="form-group">
                    <label for="desc_input">State or Condition:</label>
                    <input type="text" name = "condition" class="form-control" id="desc_input" placeholder="New/Used/Sold">
                </div>
                <label>Time between price change:</label>
                <div class="form-check form-check-inline">
                    <label><input type="radio" name="intervals" value="24"> 24 hours</label>
                </div>
                <div class="form-check form-check-inline">
                    <label><input type="radio" name="intervals" value="12"> 12 hours</label>
                </div>
                <div class="form-check form-check-inline">
                    <label><input type="radio" name="intervals" value="6"> 6 hours</label>
                </div>
                <div class="form-check form-check-inline">
                    <label><input type="radio" name="intervals" value="3"> 3 hours</label>
                </div>
                <br />
                <label>Auction Duration:</label>
                <div class="form-check form-check-inline">
                    <label><input type="radio" name="duration" value="168"> 7 days</label>
                </div>
                <div class="form-check form-check-inline">
                    <label><input type="radio" name="duration" value="120"> 5 days</label>
                </div>
                <div class="form-check form-check-inline">
                    <label><input type="radio" name="duration" value="72"> 3 days</label>
                </div>
                <div class="form-check form-check-inline">
                    <label><input type="radio" name="duration" value="24"> 1 days</label>
                </div>
                <br />
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

        </div>
    </div>

</div>