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
$noteId = $_GET['noteID'] ?? '';
$query = "SELECT * FROM phpFinal__UserNote
             WHERE phpFinal__UserNote.noteID = '$noteId'";
$result = @mysqli_query($db, $query) or die("Error loading plant note");
$note = mysqli_fetch_array($result, MYSQLI_ASSOC);


////query params
//$sort = $_GET['sort'] ?? 'PlantID';
//$dir = $_GET['dir'] ?? 'ASC';
//$start = $_GET['start'] ?? 0;
//$per_page = 10;

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
    <title>Plant Notes</title>
</head>
<body>
<h1> Delete Notes</h1>



<?php
//print_r($query);
$result = @mysqli_query($db, $query) or die("Error in query.");

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

           <?php
            //delete:
            if(isset($_POST['delete'])){
                //get values fields from form
                $noteId = $_POST['note_id'] ?? '';
                $plantId = $_POST['plant_id'] ?? '';


                //build a query
                $query = "DELETE FROM `phpFinal__UserNote`
                WHERE `phpFinal__UserNote`.`noteID` = '$noteId'";

                //execute the query
                $result = @mysqli_query($db, $query) or die("Error in query.");
                var_dump($query);


                //redirect back to the plant-protected page
                header('Location: plant-note.php?PlantID=' . $plantId);

            }

            //cancel (redirects back):
            if(isset($_POST['cancel'])){
                //get values fields from form
                $plantId = $_POST['plant_id'] ?? '';


                //redirect back to the plant-protected page
                header('Location: plant-note.php?PlantID=' . $plantId);

           }

            ?>
            <form method="post">
                <p>Are you sure you want to delete <b><?=$note['CareTips']?></b></p>
                <input type="hidden" name="note_id" value="<?= $note['noteID']?>">
                <input type="hidden" name="plant_id" value="<?= $note['PlantID']?>">


                <button type="submit" name="cancel" class="btn btn-secondary">Cancel</button>
                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </form>

    </div>


<?php else: ?>


<?php
endif;

?>

<?php
//close database connection
mysqli_close($db);

?>

</body>
</html>