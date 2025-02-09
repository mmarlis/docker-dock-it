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
$plantName = $_GET['PlantName'] ?? '';
$noteId = $_GET['noteID'] ?? '';
$query = "SELECT * FROM phpFinal__Plant
             WHERE phpFinal__Plant.PlantID = '$plantId'";
$result = @mysqli_query($db, $query) or die("Error loading note");
$note = mysqli_fetch_array($result, MYSQLI_ASSOC);

//query params
$sort = $_GET['sort'] ?? 'PlantID';
$dir = $_GET['dir'] ?? 'ASC';
$start = $_GET['start'] ?? 0;
$per_page = 10;

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
<h1> Notes</h1>



<?php

$query = "SELECT * 
            FROM phpFinal__UserNote
             WHERE PlantID = '$plantId'";
//print_r($query);
$result = @mysqli_query($db, $query) or die("Error in query.");
$total_rows = mysqli_num_rows($result);
//use num_rows to get the amount returned
echo "<p class='data-finds'> Found " . mysqli_num_rows($result) . " note/s. </p>";

//add the limit after we get the total number of rows
$query .= " LIMIT $start, $per_page";
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


        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="table-title">Comment</th>
                <th></th>
            </tr>
            </thead>
            <tbody>


            <?php

            //loop through results
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>';
//    echo  '<td>' . '<a class="plants" href="plant.php?PlantID=' . $row['PlantID'] .'">' . $row['Plant']  .  '</a></td>'; //takes to plant.php
                echo '<td>'. $row['CareTips'] .'</td>';
                echo '<td><a class="plants" href=plant-note.php?noteID=' . '">' . '</a></td>';
                        if ($_SESSION['phpFinal__User']['role'] == 'admin'):
                echo '<td><a  class="btn btn-secondary" href="delete-note.php?noteID=' . $row['noteID'] . '">Delete</a></td>';
                            ?>
            <?php endif;
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
        <!-- PAGINATION!!! -->

        <nav aria-label="Plants Pagination">
            <ul class="pagination">
                <li class="page-item <?= $start == 0 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?start=<?= $start - $per_page ?>">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item" <?= $start == 0 ? 'disabled' : '' ?>>
                    <a class="page-link" href="?start=<?= $start + $per_page ?>">Next</a>
                    <!--adds number per page to the start number per page-->
                </li>
            </ul>
        </nav>

        <a href="add-note.php?PlantID=<?=$plantId?>" class="btn btn-primary">Add Comment</a>
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