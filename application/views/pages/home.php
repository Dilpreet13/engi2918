<div class="container">
    <div class="jumbotron">
        <h1 class="display-3">Welcome to AutoBids.com</h1>
        <p class="lead"></p>
        <p><a class="btn btn-lg btn-success" href="<?php echo site_url('products'); ?>" role="button">See Inventory</a></p>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-10 col-12">
            <h4>About Us</h4>
            <p>AutoBids.com provides our clients with a platform for buying and selling cars through a Dutch Auction.</p>

            <h4>How does it work?</h4>
            <h6>Buying:</h6>
            <p>

            </p>
            <h6>Selling:</h6>
            <p>

            </p>

            <h4>Browse our Selection</h4>
            <p>To browse our current inventory, and place your bid, <?php echo anchor(site_url('products'), "click here"); ?></p>

            <h4>Contact Us</h4>
            <p>If you would like to contact us, we are available 24/7 at the number listed below.</p>
            <p><span class="glyphicon glyphicon-phone"></span> 1-807-555-2334</p>

            <?php echo "Base Url: ".base_url(); ?>
            <?php echo "Site Url: ".site_url(); ?>
        </div>
    </div>

</div>