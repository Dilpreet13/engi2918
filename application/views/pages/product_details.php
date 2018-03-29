<div class="container">
    <div class="jumbotron">
        <h1 class="display-3"><?php echo $product['name']; ?></h1>
        <p class="lead"></p>

    </div>

    <div class="row">

        <div class="col-lg-4 col-md-2 col-12">

            <p>

                <?php foreach ($images[$product['id']] as $image):?>
                    <img class = "img-fluid img-thumbnail" src="<?php echo base_url($image); ?>" />
                <?php endforeach ;?>
            </p>

        </div>

        <div class="col-lg-8 col-md-10 col-12">

            <h3>Description:</h3>
            <p>
                <?php echo $product['desc']; ?>
            </p>
            <h3>Current price:</h3>
            <p>
                <h5 class="curprice"><?php echo "$".$product['cur_price']; ?>
                </h5>
                <a href="<?php echo site_url('products/buy')."/".$product['id']; ?>"><button class="btn btn-success">Bid Now</button></a>
            </p>
            <h3>Time remaining:</h3>
            <p>

                <?php echo $product['time_remaining']." hours"; ?>

            </p>

        </div>

    </div>


</div>