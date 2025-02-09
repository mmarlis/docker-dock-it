
<?php

//connect to database
/**
 * @var $db mysqli
 */
require_once 'includes/database.php';
include "includes/header.php";
session_name('mbelisar_phpFinal');
session_start();


if (isset($_SESSION['phpFinal__User']) and $_SESSION['phpFinal__User']):
    ?>
    <nav class="navbar navbar-expand-lg navbar-light mynav">
                 <li class="nav-item">
                    <a class="nav-link" href="protected.php">Admin</a>
                </li>
                  </ul>
            <div class="text-light">
                <?php
                if(isset($_SESSION['phpFinal__User']) && $_SESSION['phpFinal__User']){
                    echo 'Welcome ' . $_SESSION['phpFinal__User']['email'] .
                        ' (<a class="admin-nav" href="login.php?logout" class="admin-nav"> Logout </a>)';
                }else{
                    echo '<a href="login.php">Login</a>';
                }
                ?>
            </div>
        </div>
    </nav>
<?php

//get query params
$sort = $_GET['sort'] ?? 'PlantID';
$dir = $_GET['dir'] ?? 'ASC';
$start = $_GET['start'] ?? 0;
$per_page = 10;

//build query
$query = "SELECT p.PlantID, p.PlantName AS Plant, pt.TypeName AS Type, un.NoteID, un.CareTips
FROM phpFinal__PlantType pt 
LEFT JOIN phpFinal__Plant p ON pt.TypeID = p.TypeID
LEFT JOIN phpFinal__UserNote un ON p.PlantID = un.PlantID
ORDER BY $sort $dir";


//execute query
$result = @mysqli_query($db, $query) or die("Error in query.");

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


    <div class="container">
        <h1>Admin Area</h1>
        <p>Create a collection of plants for your next nature project!</p>


        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" class="table-title"><a
                            href="?sort=Plant&dir=<?= $dir === 'ASC' ? 'DESC' : 'ASC' ?>">Plant</a> <i
                            class="fa-brands fa-pagelines" style="color: #549daa;"></i></th>
                <th scope="col" class="table-title"><a href="?sort=Type">Category</a></th>
                <th></th>
            </tr>
            </thead>
            <tbody>


            <?php

            //loop through results
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>';
//    echo  '<td>' . '<a class="plants" href="plant.php?PlantID=' . $row['PlantID'] .'">' . $row['Plant']  .  '</a></td>'; //takes to plant.php
                echo '<td><a class="plants" href=plant.php?PlantID=' . $row['PlantID'] . '">' . $row['Plant'] . '</a></td>';
                echo '<td>' . $row['Type'] . '</td>' . '<td></td>'  . '<td>'. '<a  class="btn btn-secondary" href="plant-note.php?PlantID=' . $row['PlantID'] . '">Comments</a></td>';
//    echo '<td><button>View</button></td>';

            echo '</tr>';
            }
            ?>
<!--                    <a href="plant-note.php" class="btn btn-primary">Add Plant</a>-->

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


         <!--Adding more plants-->



        <?php if ($_SESSION['phpFinal__User']['role'] == 'admin'): ?>
            <a href="plant-note.php" class="btn btn-primary">Add Plant</a>

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

