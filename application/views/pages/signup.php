<div class="container">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/loginpage.css") ?>"></link>
    <div class="jumbotron">
        <h1 class="display-3">Sign up</h1>
        <p class="lead">Register now to sell products or place bids</p>
    </div>
    <div class="row marketing">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="<?php echo site_url("Process/registration") ;?>" method="POST">
                <span id="reauth-email" class="reauth-email"></span>

                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Desired Password" required>
                <input type="text" id="inputFirstName" name="firstname" class="form-control" placeholder="First Name" required autofocus>
                <input type="text" id="inputLastName" name="lastname" class="form-control" placeholder="Last Name" required autofocus>
                <input type="text" id="homeAddress" name="address" class="form-control" placeholder="Shipping Address" required autofocus>
                <input type="text" id="inputFirstName" name="paypal" class="form-control" placeholder="Paypal Email" autofocus>

                <label>I am a:</label>
                <div class="radio">
                    <label><input type="radio" name="user_type" value="0">Buyer</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="user_type" value="1">Seller</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Register</button>
            </form>

        </div>

    </div>

</div>