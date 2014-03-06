<?php

require("../config.php");

if(!isset($_GET["service"])){
    echo "No service name on get";
    die();
}
$con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
//    echo "Hi";
// Check connection
if (mysqli_connect_errno()) {
    echo "Connection cannot be established";
}

$sql = "CREATE TABLE IF NOT EXISTS `" . DATABASE . "`.`" . $_GET["service"] . "` (`id` INT NOT NULL AUTO_INCREMENT ,`timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,`data` TEXT NULL ,PRIMARY KEY (`id`) )ENGINE = MyISAM;";
echo $sql;

if (mysqli_query($con,$sql)){
    echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($con);
}



mysqli_close($con);