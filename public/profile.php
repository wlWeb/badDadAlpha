<?php require_once('../private/initialize.php'); 
$title = 'Profile' ?>

<?php 

    $user_id = $_SESSION['user_id'];
    $game = [];
    $score_set = find_average_by_user_id($user_id);
    $games_set = find_games_by_user_id($user_id);
    $high = sort_by_high_game();

?>

<?php include(PRIVATE_PATH . '/head.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 text-center">
            <img src="../assets/img/avatars/<?php echo $_SESSION['avatar']; ?>" alt="Avatar">
        </div>
    </div>
</div>

<nav>
    <div class="container-fluid">
        <ul class="nav justify-content-center">
            <li class="nav">
                <a class="nav-link disabled" href="#">Edit Profile(coming soon)</a>
            </li>
            <li class="nav">
                <a href="#" class="nav-link disabled">Join League(coming soon)</a>
            </li>
            <li class="nav">
                <a class="nav-link" href="entergame.php">Enter Game</a>
            </li>
            <li class="nav">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Username</th>
            <td><?php echo $_SESSION['username']; ?></td>
        </tr>
        <tr>
            <th>City</th>
            <td><?php echo $_SESSION['city']; ?></td>
        </tr>
        <tr>
            <th>State</th>
            <td><?php echo $_SESSION['state']; ?></td>
        </tr>
        <tr>
            <th>Biography</th>
            <td><?php echo $_SESSION['bio']; ?></td>
        </tr>
        <tr>
            <th>Average</th>
            <td><?php $a = array_sum(array_column($score_set, 'score')); $average = $a / count($score_set); echo number_format($average, 2); ?></td>
        </tr>
        <tr>
            <th>High Game</th>
            <td><?php echo $high[0]; ?></td>
        </tr>
        <tr>
            <th>Low Game</th>
            <td><?php echo end($high); ?></td>
        </tr>
    </table>
</div>

<div class="container">
    <?php while($games = mysqli_fetch_assoc($games_set)) { ?>
    <table class="table-sm table-bordered table-striped">
        <thead>
            <tr>
                <th>Game</th>
                <th>Score</th>
                <th>Strikes</th>
                <th>Spares</th>
                <th>Strike %</th>
                <th>Spare %</th>
            </tr>
        </thead>
        <tbody>
            <th scope="row"><?php echo $games['id']; ?></th>
            <td><?php echo $games['score']; ?></td>
            <td><?php echo $games['strikes']; ?></td>
            <td><?php echo $games['spares']; ?></td>
            <td><?php $x = $games['strikes'] / 12; echo ceil($x * 100) ?></td>
            <td><?php $y = 12 - $games['strikes'];
                        $z = $games['spares'] / $y; echo ceil($z * 100); ?></td>
        </tbody>
    </table>
    <?php } ?>
</div>


<?php include(PRIVATE_PATH . '/footer.php'); ?>