<?php require_once('../private/initialize.php'); 
$title = 'Enter Game' ?>

<?php  

    if(is_post_request()) {

        $game['user_id'] = $_SESSION['user_id'];
        $game['score'] = $_POST['score'];
        $game['strikes'] = $_POST['strikes'];
        $game['spares'] = $_POST['spares'];

        $result = insert_game($game);
        if($result === true) {
            $_SESSION['message'] = 'Game Added. Score: ' . $game['score'];
        } else {
            $errors = $result;
        }

    }  else {
        $game['user_id'] = $_SESSION['user_id'];
        $game['score'] = '';
        $game['strikes'] = '';
        $game['spares'] = '';
    }

 ?>


<?php include(PRIVATE_PATH . '/head.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 text-center">
            <h3>Enter new game for <?php echo $_SESSION['username']; ?></h3>
            <div class="container">
                <?php echo display_session_message(); ?>
                <?php echo display_errors($errors); ?>
            </div>
        </div>
        <div class="col-6 offset-3">
            <form action="entergame.php" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="InputScore">Score</label>
                        <input type="number" class="form-control" id="InputScore" name="score" value="">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="InputStrikes">Strikes</label>
                        <input type="number" class="form-control" id="InputStrikes" name="strikes" value="">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="InputSpares">Spares</label>
                        <input type="number" class="form-control" id="InputSpares" name="spares" value="">
                        <p class="help-block"></p>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <a href="profile.php">Profile</a>
                        </div>
                        <div class="col-4">
                            <input class="btn btn-raised btn-primary" type="submit" value="Enter Game">
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>




<?php include(PRIVATE_PATH . '/footer.php'); ?>