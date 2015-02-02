<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);

require("../config.php");


function get_sql($service) {
    $SQL = "SELECT * FROM " . $service . " WHERE  `webhook_complete` = 0";
    $SQL .= " ORDER BY `timestamp` DESC LIMIT 50";
    $SQL .= ";";
    return $SQL;
}

function fetch_tables(){
    $table_list = array();
    $con=mysqli_connect(HOST,USERNAME,PASSWORD);
    if (mysqli_connect_errno()) {
        echo "there was an error connecting";
    }

    $SQL = "SHOW TABLES FROM " . DATABASE . "";
    //echo $SQL;

    $result = mysqli_query($con, $SQL);
    if($result){
        while($row = mysqli_fetch_array($result)) {
            $table_list[] =  $row[0];
        }
    }
    mysqli_close($con);
    return $table_list;
}

function do_curl_call($service, $row){
    echo $service;
    echo "\n";
    print_r($row);
}

function run_calls(){
    $table_list = fetch_tables();
    $con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if (mysqli_connect_errno()) {
        echo "there was an error connecting";
        echo "\n";
    }

    foreach($table_list as $table_name){
        $SQL = get_sql($table_name);
        echo $SQL;
        echo "\n";
        $result = mysqli_query($con, $SQL);
        if($result){
            while($row = mysqli_fetch_array($result)) {
                do_curl_call($table_name, $row);
            }
        }
    }
    mysqli_close($con);
}


run_calls();