<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);

require("../config.php");

function fetch_data($keys){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if (mysqli_connect_errno()) {
        echo "there was an error connecting";
    }
    $SQL = "SELECT * FROM " . $_GET["service"] . ";";
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
    if (isset($_GET["service"]) && isset($_GET["keys"])) {
?>
    <html>
    <head></head>
    <body>
    <table>
        <thead>
            <tr>
                <td>Date</td>
                <?php
                    foreach(explode(",", $_GET["keys"]) as $key){
                        echo "<td>" . $key . "</td>";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
        <?php fetch_data(explode(",", $_GET["keys"])); ?>
        </tbody>
    </table>
    </body>
    </html>

<?php
    } else {
        echo "service or keys not provided in get params.";
        return;
    }
?>