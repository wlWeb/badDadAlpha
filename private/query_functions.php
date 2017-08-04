<?php 

    function find_all_users() {
        global $db;
        $sql = "SELECT * FROM users ";
        $sql .= "ORDER BY id DESC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_user_by_id($id) {
        global $db;
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        $sql .= "ORDER BY id DESC ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result); // find first
        mysqli_free_result($result);
        return $user; // returns an assoc. array
    }
    
    
  function validate_user($user) {
    if(is_blank($user['city'])) {
      $errors[] = "City name cannot be blank.";
    } elseif (!has_length($user['city'], array('min' => 2, 'max' => 255 ))) {
      $errors[] = "City must be between 2 and 255 characters.";
    }

    if(is_blank($user['state'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['state'], array('min' => 2, 'max' => 255 ))) {
      $errors[] = "State must be between 2 and 255 characters.";
    }

    if(is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user['email'], array('max' => 255 ))) {
      $errors[] = "Email ust be less than 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($user['username'])) {
      $errors[] = "username cannot be blank.";
    } elseif(!has_length($user['username'], array('min' => 6, 'max' => 255))) {
      $errors[] = "Username must be between 6 and 255 charaacters.";
    } elseif(!has_unique_username($user['username'], $user['id'] ?? 0)) {
      $errors[] = "username not allowed. Try another.";
    }

    if(is_blank($user['password'])) {
      $errors[] = "Password cannot be blank.";
    } elseif (!has_length($user['password'], array('min' => 10))) {
      $errors[] = "Password must contain 10 or more characters";
    } elseif(!preg_match('/[A-Z]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 uppercase letter";
    } elseif(!preg_match('/[a-z]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 lowercase letter"; 
    } elseif(!preg_match('/[0-9]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 number";
    } elseif(!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
      $errors[] = "Password must contain at least 1 symbol";
    }

    if(is_blank($user['confirm_password'])) {
      $errors[] = "Confrim password cannot be blank.";
    } elseif ($user['password'] !== $user['confirm_password']) {
      $errors[] = "Password and confirm password must match.";
    }

    return $errors;
  }

    function insert_user($user) {
        global $db;

        $errors = validate_user($user);
        if (!empty($errors)) {
        return $errors;
        }

        $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users ";
        $sql .= "(city, state, email, username, bio, hashed_password, avatar) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $user['city']) . "',";
        $sql .= "'" . db_escape($db, $user['state']) . "',";
        $sql .= "'" . db_escape($db, $user['email']) . "',";
        $sql .= "'" . db_escape($db, $user['username']) . "',";
        $sql .= "'" . db_escape($db, $user['bio']) . "',";
        $sql .= "'" . db_escape($db, $hashed_password) . "',";
        $sql .= "'" . db_escape($db, $user['avatar']) . "'";
        $sql .= ")";
        $result = mysqli_query($db, $sql);

        // For INSERT statements, $result is true/false
        if($result) {
        return true;
        } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
        }

    }

  function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function find_average_by_user_id($user_id) {
      global $db;

      $sql = "SELECT score FROM games ";
      $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $games = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $games;
  }

  function find_games_by_user_id($user_id) {
      global $db;

      $sql = "SELECT * FROM games ";
      $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;
  }

function validate_game($game) {
        if(is_blank($game['score'])) {
        $errors[] = "Score cannot be blank.";
    } elseif ($game['score'] > 300) {
        $errors[] = "You ain't that pro ya dingus!";
    }

        if(is_blank($game['strikes'])) {
        $errors[] = "Strikes cannot be blank.";
    } elseif ($game['strikes'] > 12) {
        $errors[] = "You ain't that pro ya dingus!";
    }

         if(is_blank($game['spares'])) {
        $errors[] = "Spares cannot be blank.";
    } elseif ($game['spares'] > (12 - $game['strikes']))  {
        $errors[] = "You ain't that pro ya dingus!";
    }   
}
 
function insert_game($game) {
    global $db;

    $errors = validate_game($game);
        if (!empty($errors)) {
        return $errors;
        }


    $sql = "INSERT INTO games ";
    $sql .= "(user_id, score, spares, strikes) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db,$game['user_id']) . "',";
    $sql .= "'" . db_escape($db,$game['score']) . "',";
    $sql .= "'" . db_escape($db,$game['spares']) . "',";
    $sql .= "'" . db_escape($db,$game['strikes']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

    function sort_by_high_game() {
        global $db;
        $sql = "SELECT score FROM games ";
        $sql .= "ORDER BY score DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $high = array();
    while($row = mysqli_fetch_assoc($result)) {
        $high[] = $row['score'];
    }; // find first
    mysqli_free_result($result);
    return $high; // returns an assoc. array
  }


?>
