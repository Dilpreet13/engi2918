<div class="container">
    <div class="jumbotron">
        <h1 class="display-3">My current auctions</h1>
        <p class="lead"></p>
        <p><a class="btn btn-lg btn-success" href="<?php echo site_url('products'); ?>" role="button">See Inventory</a></p>
    </div>

    <table class="table">

        <thead>
        <tr>
            <th scope="col">SKU</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Current price</th>
            <th scope="col">Time remaining</th>
            <th scope="col">Actions</th>
            <th scope="col"></th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($products as $product): ?>

                <tr>

                    <th scope="row"><?php echo $product->SKEW; ?></th>
                    <td><?php echo anchor(site_url("products/view"."/".$product->SKEW), $product->Name); ?>
                        <br/>
                        <img class="img-thumbnail img-fluid" src="<?php if(isset($images[$product->SKEW][0])) echo(base_url().$images[$product->SKEW][0]) ; ?>" />
                    </td>
                    <td><?php echo $product->Description; ?></td>
                    <td><?php echo $product->Currentprice; ?></td>
                    <td><?php echo ($time_remaining[$product->SKEW]." hours");?></td>
                    <td><?php echo anchor('products/unlist'."/".$product->SKEW, "Delist"); ?></td>

                </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>