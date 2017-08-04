<?php 
include('../private/initialize.php');
$title = "Register";
?>


<?php

if(is_post_request()) {

    //File handling
  $file = $_FILES['avatar'];

  $fileName = $_FILES['avatar']['name'];
  $fileTmpName = $_FILES['avatar']['tmp_name'];
  $fileSize = $_FILES['avatar']['size'];
  $fileError = $_FILES['avatar']['error'];
  $fileType = $_FILES['avatar']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  $last = $_POST['username'];

  $allowed = array('jpg','jpeg', 'png', 'gif','bmp');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 5000000000) {
        $avatarNameNew = $_POST['username'] . "_avatar." . $fileActualExt;
        $fileDestination = '../assets/img/avatars/' . $avatarNameNew;
        $avatarLink = explode("/", $fileDestination);
        $user = [];
        $user['city'] = $_POST['city'] ?? '';
        $user['state'] = $_POST['state'] ?? '';
        $user['email'] = $_POST['email'] ?? '';
        $user['username'] = $_POST['username'] ?? '';
        $user['password'] = $_POST['password'] ?? '';
        $user['bio'] = $_POST['bio'] ?? '';
        $user['confirm_password'] = $_POST['confirm_password'] ?? '';
        $user['avatar'] = strtolower(end($avatarLink));

        $result = insert_user($user);
        if($result === true) {
            $new_id = mysqli_insert_id($db);
            $_SESSION['message'] = 'user created.';
            move_uploaded_file($fileTmpName, $fileDestination);
            redirect_to(PROJECT_PATH . 'index.php');
        } else {
            $errors = $result;
        }
      } else {
        $errors[] = "Your file is too large!";
      }
    } else {
      $errors[] = "There was an error loading your file!";
    }
  } else {
    $errors[] = "you cannot upload files of this type!";
  }

  // Handle form values sent by apply.php

  



} else {
  // display the blank form
  $user = [];
  $user["first_name"] = '';
  $user["last_name"] = '';
  $user["email"] = '';
  $user["username"] = '';
  $user['password'] = '';
  $user['confirm_password'] = '';
  $user['avatar'] = '';
}

?>


    <?php include(PRIVATE_PATH . '/head.php'); ?>

    <div class="site_container">

        <header>
            <div class="container-fluid text-center">
                <div class="header bg-primary color-primary">
                    <h1>Register</h1>
                    <p class="lead">From Sad Lad to Bad Dad</p>
                </div>
            </div>
        </header>
        <div class="container">
            <?php echo display_errors($errors); ?>
            </p>
        </div>
        <div class="container login">
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <label for="InputUsername">Username</label>
                        <input type="text" class="form-control" id="InputUsername" name="username" value="">
                        <p class="help-block">

                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Email</label>
                        <input type="email" class="form-control" id="InputEmail" name="email" value="">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="InputCity">City</label>
                        <input type="text" class="form-control" id="InputCity" name="city" value="">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="InputState">State</label>
                        <input type="text" class="form-control" id="InputState" name="state" value="">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="Inputbio">Bio</label>
                        <textarea class="form-control" id="Inputbio" rows="3" name="bio" value=""></textarea>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="inputFile" class="control-label">Profile Pic</label>
                        <input type="text" readonly="" class="form-control" name="avatar" placeholder="Include Your avatar Here">
                        <input type="file" id="inputFile" name="avatar" accept=".jpg,.jpeg,.png,.gif,.bmp">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" value="">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="InputConfirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="ConfirmInputPassword" name="confirm_password" value="">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group text-center">
                        <input class="btn btn-raised btn-primary" type="submit" value="Register">

                    </div>
                </fieldset>
            </form>
        </div>


        <?php include (PRIVATE_PATH . '/footer.php'); ?>