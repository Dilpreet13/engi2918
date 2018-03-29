<?php
/**
 * Created by PhpStorm.
 * User: Ian Cuninghame
 * Date: 2018-03-19
 * Time: 5:37 PM
 */
?>
<navbar class="navbar navbar-light bg-light">

    <nav class="nav float-right">
        <a class="navbar-brand" href="<?php echo site_url("pages/view/home"); ?>">
            AutoBids
        </a>
        <ul class="nav nav-pills ">
            <li class="nav-item">
                <a class="nav-link " href="<?php echo site_url("pages/view/home"); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?php echo site_url("products"); ?>">Inventory</a>
            </li>


                <li class="nav-item">
                    <a class="nav-link " href="<?php echo site_url("products/buy"); ?>">Buy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo site_url("products/sell"); ?>">Sell</a>
                </li>

                <?php if (!isset($logged_in) || $logged_in == FALSE) :?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("login"); ?>">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("pages/view/signup"); ?>">Sign up</a>
                    </li>

                <?php elseif (isset($logged_in) && $logged_in == TRUE): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("products/my_auctions"); ?>">My Auctions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("products/my_purchases"); ?>">My Purchases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url("user/logout"); ?>">Logout</a>
                    </li>
                <?php endif; ?>


                <!--
                <li class="nav-item">
                    <a class="nav-link" href="">Sign out</a>
                </li>-->


        </ul>
    </nav>

</navbar>
