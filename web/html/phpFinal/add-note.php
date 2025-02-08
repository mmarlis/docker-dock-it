<?php
//connect to database
/**
 * @var $db mysqli
 */
require_once 'includes/database.php';
include "includes/header.php";
session_name('mbelisar_phpFinal');
session_start();

//load one specific record
$plantId = $_GET['PlantID'] ?? '';
$query = "SELECT * FROM phpFinal__Plant WHERE PlantID = '$plantId'";
$result = @mysqli_query($db, $query) or die("Error loading note");
$plant = mysqli_fetch_array($result, MYSQLI_ASSOC);

print_r($query);
//var_dump($query);

//execute query
//$result = @mysqli_query($db, $query) or die("Error in query.");

//for debugging:
//$result = @mysqli_query($db, $query) or die("Error in query:" . mysqli_error($db));

//Use num_rows to get the amount returned
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Notes</title>
</head>
<body>

<h1> Add Notes To </h1>



<?php
if(isset($_POST['add'])) {
    $plantId = $_POST['plantID'] ?? '';
    $careTips = $_POST['care-tips'] ?? '';


    $query = "INSERT INTO `phpFinal__UserNote`
                (`PlantID`,`CareTips`)
                VALUES 
                    (?, ?)";
    $stmt = @mysqli_prepare($db, $query) or die ('Error in query.');
    mysqli_stmt_bind_param($stmt,'is', $plantId, $careTips );
    $result = @mysqli_stmt_execute($stmt) or die('Error updating comment');

//print_r($query);


    $newNoteId = mysqli_insert_id($db);

    if($newNoteId){
        header('Location: plant-note.php?PlantID=' . $plantId);
    }

}
?>

<form method="post">
    <div class="mb-3">
        <label for="plant" class="form-label">Plant</label>
        <input type="text" name="plant" class="form-control" id="plant" disabled value="<?= $plant['PlantName'] ?>">
        <input type="hidden" name="plantID" value="<?= $plant['PlantID'] ?>">
    </div>

    <div class="mb-3">
        <label for="care-tips" class="form-label">Care Tips</label>
        <textarea type="text" class="form-control" id="care-tips" name="care-tips"></textarea>

        <button type="submit" name="add" class="btn btn-primary">Add Comment</button>

</form>


<?php
//TODO: FIX Navbar!!! 05/12

if (isset($_SESSION['phpFinal__User']) and $_SESSION['phpFinal__User']):
    ?>
    <nav class="navbar navbar-expand-md navbar-light mynav">
        <a class="navbar-brand" href="#">My Site</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="plants.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="protected.php">Admin</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            <div class="text-light">
                <?php
                if(isset($_SESSION['phpFinal__User']) && $_SESSION['phpFinal__User']){
                    echo 'Welcome ' . $_SESSION['phpFinal__User']['email'] .
                        ' (<a href="login.php?logout"> Logout </a>)';
                }else{
                    echo '<a href="login.php">Login</a>';
                }
                ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Admin Area</h1>
        <p>Add notes to your next project</p>


        <table class="table table-hover">
            <thead>
            <tr>
                 <th scope="col" class="table-title">Note</th>
                <th></th>
            </tr>
            </thead>
            <tbody>


            <?php

            //loop through results
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>';
//    echo  '<td>' . '<a class="plants" href="plant.php?PlantID=' . $row['PlantID'] .'">' . $row['Plant']  .  '</a></td>'; //takes to plant.php
                echo '<td>'. $row['care-tips'] .'</td>';
                echo '<td><a class="plants" href=plant-note.php?NoteID=' . '">' . '</a></td>';

//    echo '<td><button>View</button></td>';
                echo'</tr>';
            }
            ?>



            <?php
            //close database connection
            mysqli_close($db);

            ?>
            </tbody>
        </table>

<!--        <button type="submit" name="add" class="btn btn-primary">Add Note</button>-->
        <!--Adding more plants-->

        <!--        <a href="plant-note.php" class="btn btn-primary">Add Plant</a>-->

        <?php if ($_SESSION['phpFinal__User']['role'] == 'admin'): ?>
            <button class="btn btn-primary">Edit</button>
        <?php endif; ?>
    </div>


<?php else: ?>
    <div class="container">
        <h1>Admin Area</h1>
        <div class="alert alert-danger">Access denied. Please <a href="login.php">login</a>.</div>
    </div>

<?php
endif;

?>

</body>
</html>