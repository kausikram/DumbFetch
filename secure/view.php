<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);

require("config.php");

function fetch_data($keys){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if (mysqli_connect_errno()) {
        return_error();
    }
    $SQL = "SELECT * FROM " . TABLE . ";";
    $result = mysqli_query($con, $SQL);
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
    mysqli_close($con);
}
?>

<html>
<head></head>
<body>
<table>
    <thead>
        <tr><td>Date</td><td>Email</td><td>Phone Number</td></tr>
    </thead>
    <tbody>
    <?php fetch_data(array("email","phone")); ?>
    </tbody>
</table>
</body>
</html>