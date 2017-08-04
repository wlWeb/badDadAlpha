<?php 
include('private/initialize.php');
$title = "Home";
?>

<?php 

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Log in was unsuccessful.";

    $user = find_user_by_username($username);
    if($user) {

      if(password_verify($password, $user['hashed_password'])) {
        // password matches
        log_in_user($user);
        redirect_to('public/profile.php');
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }

    } else {
      // no username found
      $errors[] = $login_failure_msg;
    }

  }

}

?>

<?php include('private/head.php'); ?>

<div class="site_container">

    <header>
        <div class="container-fluid text-center">
            <div class="header bg-primary color-primary">
                <h1>Welcome to Bad Dad</h1>
                <p class="lead">Dad/Dad would recommend</p>
            </div>
        </div>
    </header>
    <div class="container">
        <?php echo display_errors($errors); ?>
        </p>
    </div>

    <div class="container login">
        <form action="index.php" method="POST">
            <fieldset>
                <div class="form-group">
                    <label for="InputUsername">Username</label>
                    <input type="text" class="form-control" id="InputUsername" name="username" value="">
                    <p class="help-block"></p>
                </div>
                <div class="form-group">
                    <label class="control-label" for="ms-form-pass">Password</label>
                    <input name="password" type="password" id="ms-form-pass" class="form-control animated fadeInDown animation-delay-8">
                    <p class="help-block"></p>
                </div>
                <div class="form-group text-center">
                    <div class="row">
                        <div class="col-4">
                            <a href="<?php echo url_for('public/register.php'); ?>" class="btn btn-outline-warning">Register</a>
                        </div>
                        <div class="col-4">
                            <input class="btn btn-raised btn-primary" type="submit" value="Log In">
                            </div>
                        </div>
                    
                </div>
            </fieldset>    
        </form>
     </div> 

</div>



<?php include('private/footer.php'); ?>

