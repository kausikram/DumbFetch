<?php

require("config.php");

function create_table(){
    $sql = "CREATE  TABLE `dumpfetch`.`signup_dump` (`id` INT NOT NULL AUTO_INCREMENT ,`timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,`data` TEXT NULL ,PRIMARY KEY (`id`) )ENGINE = MyISAM;";
}

function check(){
    if(!$_GET["api_key"]){
        return_error();
        die();
    }
    if($_GET["api_key"]!=API_KEY){
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
    $SQL = "INSERT INTO ". DATABASE . "." . TABLE . "(data) VALUES ('$value');";
    mysqli_query($con, $SQL);
}

function return_true(){
    echo $_GET["callback"].'("ok")';
}

function return_error(){
    echo $_GET["callback"].'("error connecting database")';
}

check();
write_data();
return_true();