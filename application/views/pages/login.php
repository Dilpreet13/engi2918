<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - Login Form View
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2018, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

if( ! isset( $optional_login ) )
{

}

if( ! isset( $on_hold_message ) )
{
    if( isset( $login_error_mesg ) )
    {
        echo '
			<div style="border:1px solid red;">
				<p>
					Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username, Email Address, or Password.
				</p>
				<p>
					Username, email address and password are all case sensitive.
				</p>
			</div>
		';
    }

    if( $this->input->get(AUTH_LOGOUT_PARAM) )
    {
        echo '
			<div style="border:1px solid green">
				<p>
					You have successfully logged out.
				</p>
			</div>
		';
    }

?>

<div class="container">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/loginpage.css") ?>"></link>
    <div class="jumbotron">
        <h1 class="display-3">Sign in</h1>
        <p class="lead">If you don't have an account already, <a href="<?php echo site_url("Pages/view/signup"); ?>">register here.</a></p>
    </div>
    <div class="row marketing">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <?php $form_attributes = array('class' => 'std-form form-signin', 'id' => 'signinform');
            echo form_open($login_url, $form_attributes ); ?>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputUsername" name="login_string" class="form-control form-input" placeholder="Username" required autofocus>
                <input type="password" id="inputPassword" name="login_pass" class="form-control form-input" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form>
            <!-- /form -->
        </div>

    </div>

</div>

<?php

    } else
    {
    // EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
    echo '
			<div style="border:1px solid red;">
				<p>
					Excessive Login Attempts
				</p>
				<p>
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				<p>
				<p>
					Your access to login and account recovery has been blocked for ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes.
				</p>
				<p>
					Please use the <a href="/examples/recover">Account Recovery</a> after ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				</p>
			</div>
		';
} ?>