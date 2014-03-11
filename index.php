<?php

require("config.php");

function check(){
    if(!isset($_GET["api_key"])){
        return_error();
        die();
    }
    if($_GET["api_key"]!=API_KEY){
        return_error();
        die();
    }
    if(!isset($_GET["service"])){
        return_error();
        die();
    }
}

function write_data(){
    $con=mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
//    echo "Hi";
    // Check connection
    if (mysqli_connect_errno()) {
        return_error();
    }
    $value = json_encode($_GET);
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

function return_error(){
    if(isset($_GET["callback"])){
        echo $_GET["callback"].'("error connecting database")';
    }
    else {
        echo "error connecting database";
    }
}

check();
write_data();
return_true();