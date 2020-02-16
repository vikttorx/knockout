<?php

include 'db.php';

$sql = 'SELECT * FROM `player`';
$statement = $con->prepare($sql);
$statement->execute();
$players = $statement->fetchAll(PDO::FETCH_UNIQUE);


$sql = 'SELECT * FROM `pool`  ORDER BY RAND();';
$statement = $con->prepare($sql);
$statement->execute();
$player = $statement->fetchAll(PDO::FETCH_OBJ);

if (isset ($_POST['win_by_player'])  && isset($_POST['round_type_id']) && isset($_POST['day']) && isset($_POST['in_time']) && isset($_POST['end_time']) ) {
    $win_by_player = $_POST['win_by_player'];
    $round_type_id = $_POST['round_type_id'];
    $day = $_POST['day'];
    $in_time = $_POST['in_time'];
    $end_time = $_POST['end_time'];
    $sql = 'INSERT INTO matching(win_by_player, round_type_id, day, in_time, end_time) VALUES(:win_by_player, :round_type_id, :day, :in_time , :end_time)';
    $statement = $con->prepare($sql);
    if ($statement->execute([':win_by_player' => $win_by_player, ':round_type_id' => $round_type_id, ':day' => $day,  ':in_time' => $in_time, ':end_time' => $in_time])) {
        $message = 'data inserted successfully';

    }

    header("location: knockout.php");
}


$sql = 'SELECT * FROM rounds ';
$statement = $con->prepare($sql);
$statement->execute();
$rounds = $statement->fetchAll(PDO::FETCH_ASSOC);


$sql = 'SELECT * FROM matching WHERE round_type_id = 1 ORDER BY RAND()';
$statement = $con->prepare($sql);
$statement->execute();
$roundtwo = $statement->fetchAll(PDO::FETCH_OBJ);


$sql = 'SELECT * FROM matching WHERE round_type_id = 2 ORDER BY RAND()';
$statement = $con->prepare($sql);
$statement->execute();
$roundthree = $statement->fetchAll(PDO::FETCH_OBJ);
?>





<table border='1' cellspacing='2' cellpadding='2'>



    <tr><td colspan='2' width='120'><b>Round 1</b>
    <?php foreach($player as $player): ?>

    <tr><td>Group</td></tr>
    <tr><td align='center'><?= $players[$player->player_name_1]['name']; ?> vs <?= $players[$player->player_name_2]['name']; ?> </td></tr>


    <td></td>
    <td>
        <iframe name="votar" style="display:none;"></iframe>
        <form method="post" target="votar">
            <div class="form-group">
                <label for="win_by_player">Winner:</label>
                <input type="text" name="win_by_player" id="win_by_player" class="form-control">
            </div>
            <div class="form-group">
                <label for="round_type_id">Round:</label>

                <select name="round_type_id">
                    <?php

                    foreach($rounds as $round)
                    {
                        echo "<option value=\"{$round['id']}\">{$round['id']} {$round['round_type']}</option>";
                    }

                    ?>


                </select>
            </div>
            <div class="form-group">
                <label for="day">Day:</label>
                <input type="date" name="day" id="day" class="form-control">
            </div>
            <div class="form-group">
                <label for="in_time">Start time:</label>
                <input type="time" name="in_time" id="in_time" class="form-control">
            </div>
            <div class="form-group">
                <label for="end_time">End time:</label>
                <input type="time" name="end_time" id="end_time" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info" onclick="myFunction()">Update Scoreboard</button>
            </div>
        </form>
        <p id="demo"></p>
    </td>




    <?php endforeach; ?>




</table>

<table border='1' cellspacing='2' cellpadding='2'>

    <tr><td colspan='2' width='120'><b>Round 2</b>
            <?php foreach($roundtwo as $two): ?>

    <tr><td>Group</td></tr>
    <tr><td align='center'><?= $two->win_by_player; ?></td>



    <td>
        <form method="post">

            <div class="form-group">
                <label for="round_type_id">Round:</label>

                <select name="round_type_id">
                    <?php

                    foreach($rounds as $round)
                    {
                        echo "<option value=\"{$round['id']}\">{$round['id']} {$round['round_type']}</option>";
                    }

                    ?>


                </select>
            </div>
            <div class="form-group">
                <label for="day">Day:</label>
                <input type="date" name="day" id="day" class="form-control">
            </div>
            <div class="form-group">
                <label for="in_time">Start time:</label>
                <input type="time" name="in_time" id="in_time" class="form-control">
            </div>
            <div class="form-group">
                <label for="in_time">End time:</label>
                <input type="time" name="end_time" id="end_time" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info">Update Scoreboard</button>
            </div>
        </form>
    </td>




    <?php endforeach; ?>
</table>
<table border='1' cellspacing='2' cellpadding='2'>

    <tr><td colspan='2' width='120'><b>Round 3</b>
            <?php foreach($roundthree as $three): ?>

    <tr><td>Group</td></tr>
    <tr><td align='center'><?= $three->win_by_player; ?></td>



        <td>
        </table>
<?php endforeach; ?>


<script>
    function myFunction() {
        document.getElementById("demo").innerHTML = "Inserted succesfully!";
    }
</script>