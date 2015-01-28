<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);

require("../config.php");


function get_sql() {
    $SQL = "SELECT * FROM " . $_GET["service"];

    if(isset($_GET["from"])) {
        $SQL .= " WHERE  `timestamp` > " . $_GET["from"];
    }

    if(isset($_GET["to"])) {
        $SQL .= " and  `timestamp` < " . $_GET["to"];
    }

    $SQL .= " ORDER BY `timestamp` DESC";

    if(!isset($_GET["from"])){
        $SQL .= " LIMIT 50";
    }

    $SQL .= ";";
    return $SQL;
}

function fetch_as_json(){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if (mysqli_connect_errno()) {
        echo "there was an error connecting";
    }

    $SQL = get_sql();
    $results_to_be_jsoned = array();

    $result = mysqli_query($con, $SQL);
    if($result){
        while($row = mysqli_fetch_array($result)) {
            $content = array();
            $content["timestamp"] = $row["timestamp"];
            $content["data"] = $row["data"];
            $content["id"] = $row["id"];
            $results_to_be_jsoned[] = $content;
        }
    }
    die(json_encode($results_to_be_jsoned));
    mysqli_close($con);
}

function fetch_all_data(){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if (mysqli_connect_errno()) {
        echo "there was an error connecting";
    }

    $SQL = get_sql();
    echo $SQL;

    $result = mysqli_query($con, $SQL);
    if($result){
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row["timestamp"] ."</td>";
            echo "<td>" . $row["data"] ."</td>";
            echo "</tr>";
        }
    }
    mysqli_close($con);
}

function fetch_data($keys){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if (mysqli_connect_errno()) {
        echo "there was an error connecting";
    }

    $SQL = get_sql();
    echo $SQL;

    $result = mysqli_query($con, $SQL);
    if($result){
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            $data = json_decode($row["data"],true);
            echo "<td>" . $row["timestamp"] ."</td>";
            foreach($keys as $key){
                if(isset($data[$key])){
                    echo "<td>" . $data[$key] ."</td>";
                } else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        }
    }
    mysqli_close($con);
}

?>

<?php
    if (!isset($_GET["service"])){
        echo "service name not provided in get params.";
        return;
    }
    if(isset($_GET["dataType"]) && $_GET["dataType"]=="json"){
        header('Content-Type: application/json');
        fetch_as_json();
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>

<body>
<table class="table table-striped">
    <thead>
    <?php
        if (isset($_GET["keys"])){
    ?>
        <tr>
            <td>Date</td>
            <?php
                foreach(explode(",", $_GET["keys"]) as $key){
                    echo "<td>" . $key . "</td>";
                }
            ?>
        </tr>
    <?php  } else { ?>
        <tr>
            <td>Date</td>
            <td> Dump</td>
        </tr>
    <?php } ?>
    </thead>
    <tbody>
    <?php
        if (isset($_GET["keys"])){
            fetch_data(explode(",", $_GET["keys"]));
                return;
            } else {
                fetch_all_data();
            }
     ?>
    </tbody>
</table>
</body>
</html>