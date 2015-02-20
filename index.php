<?php

require("config.php");

function check(){
    if(!isset($_GET["api_key"])){
        return_error("Error in connecting to the system");
        die();
    }
    if($_GET["api_key"]!=API_KEY){
        return_error("Error in connecting to the system");
        die();
    }
    if(!isset($_GET["service"])){
        return_error("Error in connecting to the system");
        die();
    }
}

function write_data(){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
//    echo "Hi";
    // Check connection
    if (mysqli_connect_errno()) {
        return_error("Error connecting to the system");
    }
    $value = json_encode($_GET);
    $striped_val = strip_tags($value);
    if ($value != $striped_val){
        return_error("Sorry We do not allow HTML Data.");
        die();
    }
    $SQL = "INSERT INTO ". DATABASE . "." . $_GET["service"] . "(data) VALUES ('$value');";
    mysqli_query($con, $SQL);
}

function return_true(){
    if(isset($_GET["callback"])){
        echo $_GET["callback"].'("ok")';
    } else {
        echo "ok";
    }
}

function return_error($error_message){
    //$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
    //header($protocol . ' 400 ' . "Bad Response.");
    if(isset($_GET["callback"])){
        echo 'alert($error_message)';
    }
    else {
        echo $error_message;
    }
}

check();
write_data();
return_true();