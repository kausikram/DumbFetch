<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);

require("../config.php");


function fetch_tables(){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD);
    if (mysqli_connect_errno()) {
        echo "there was an error connecting";
    }

    $SQL = "SHOW TABLES FROM " . DATABASE . "";
    //echo $SQL;

    $result = mysqli_query($con, $SQL);
    if($result){
        echo "<ul>";
        while($row = mysqli_fetch_array($result)) {
            echo "<li>" . $row[0] ."</li>";
        }
        echo "</ul>";
    }
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-xs-9">
            <h3>Existing Services</h3>
            <?php fetch_tables(); ?>
        </div>
        <div class="col-xs-3">
            <h3>Build New Service</h3>
            <form action="build_service.php" method="GET">
                <div class="form-group">
                    <label for="service">Service Name</label>
                    <input class="form-control" type="text" name="service">
                </div>
                <button type="submit">Create Service</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
