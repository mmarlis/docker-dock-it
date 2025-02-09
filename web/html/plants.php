<?php
//connect to database
/**
 * @var $db mysqli
 */
require_once 'includes/database.php';

//get query params
$sort = $_GET['sort'] ?? 'PlantID';
$dir = $_GET['dir'] ?? 'ASC';
$start = $_GET['start'] ?? 0;
$per_page = 10;

?>
<?php
include "includes/header.php";
?>


<?php

//build query
$query = "SELECT p.PlantID, p.PlantName AS Plant, pt.TypeName AS Type
FROM phpFinal__PlantType AS pt 
LEFT JOIN phpFinal__Plant AS p ON pt.TypeID = p.TypeID
ORDER BY $sort $dir";

//execute query
$result = @mysqli_query($db, $query) or die("Error in query.");
?>
    <nav class="navbar navbar-expand-lg navbar-light mynav">
        <a class="navbar-brand" href="#">Grow your Roots</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login/Register <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

<?php

//for debugging:
//$result = @mysqli_query($db, $query) or die("Error in query:" . mysqli_error($db));

//Use num_rows to get the amount returned
$total_rows = mysqli_num_rows($result);
//use num_rows to get the amount returned
echo "<p class='data-finds'> Found " . mysqli_num_rows($result) . " plants. </p>";

//add the limit after we get the total number of rows
$query .= " LIMIT $start, $per_page";
$result = @mysqli_query($db, $query) or die("Error in query.");
?>

    <div class="welcome">
        <section>
            <h3>Welcome to our Database</h3>
            <p class="home-description">This is an interactive website where you will be able to explore the magical
                world of plants to start next backyard or indoor project.</p>
        </section>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col" class="table-title"><a
                        href="?sort=Plant&dir=<?= $dir === 'ASC' ? 'DESC' : 'ASC' ?>">Plant</a> <i
                        class="fa-brands fa-pagelines" style="color: #549daa;"></i></th>
            <th scope="col" class="table-title"><a href="?sort=Type">Category</a></th>
        </tr>
        </thead>
        <tbody>


        <?php

        //loop through results
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
//    echo  '<td>' . '<a class="plants" href="plant.php?PlantID=' . $row['PlantID'] .'">' . $row['Plant']  .  '</a></td>'; //takes to plant.php
            echo '<td><a class="plants" href="plant.php?PlantID=' . $row['PlantID'] . '">' . $row['Plant'] . '</a></td>';
            echo '<td>' . $row['Type'] . '</td>';
//    echo '<td><button>View</button></td>';
          echo '</tr>';
        }
        ?>
        <!--        <a href="add-plant-note.php" class="btn btn-primary">Add Plant</a>-->

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

    </body>
    </div>
    </html>

<?php
