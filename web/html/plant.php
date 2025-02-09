<?php
//connect to database
/**
 * @var $db mysqli
 */
require_once 'includes/database.php';
$plantId = $_GET['PlantID'] ?? '';
$safe_code = mysqli_real_escape_string($db, $plantId);
$query = "SELECT p.ImageName, p.PlantID , p.PlantName AS Plant, pt.TypeName AS Type, p.phLevel AS SoilPHLevel, lf.CycleName AS LifeCycle, p.SunExposure
FROM phpFinal__LifeCycle lf
LEFT JOIN phpFinal__Plant p ON lf.CycleID = p.CycleID
LEFT JOIN phpFinal__PlantType pt ON p.TypeID = pt.TypeID
WHERE p.PlantID = '$safe_code'";


$result = @mysqli_query($db, $query) or die("Error loading plant.");
$plant = mysqli_fetch_array($result, MYSQLI_ASSOC);



//var_dump($_GET['plantId']);
?>
<?php
include "includes/header.php";
?>


    <?php


    ?>
    <div class="card">


        <div class="card-body">
            <img src="uploads/plants/<?= $plant['ImageName'] ?>" alt="<?= $plant['Plant'] ?>" width="200" height="200">
            <h3 class="card-title"><?= $plant['Plant'] ?></h3>
            <p class="card-text"><span class="titles">Type: </span><?= $plant['Type'] ?></p>
            <p class="card-text"><span class="titles">Sun Exposure: </span><?= $plant['SunExposure'] ?></p>
            <p class="card-text"><span class="titles">Soil PH Level: </span><?= $plant['SoilPHLevel'] ?></p>
<!--            <button href="add-plant-note.php" class="btn btn-primary">Add Note</button>-->

        </div>
    </div>

    <?php

//    var_dump($plantId);

    //close database connection
    mysqli_close($db);

    ?>

    </body>
</div>
</html>

