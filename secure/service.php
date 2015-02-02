<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);

require("../config.php");



function fetch_as_json(){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD);
    if (mysqli_connect_errno()) {
        echo "there was an error connecting";
    }
    $SQL = "SHOW TABLES FROM " . DATABASE . "";

    $results_to_be_jsoned = array();

    $result = mysqli_query($con, $SQL);
    if($result){
        while($row = mysqli_fetch_array($result)) {
            $data_array = array();
            $data_array["id"] = $row[0];
            $data_array["name"] = $row[0];
            $results_to_be_jsoned[] = $data_array;
        }
    }
    die(json_encode($results_to_be_jsoned));
    mysqli_close($con);
}
fetch_as_json();
?>