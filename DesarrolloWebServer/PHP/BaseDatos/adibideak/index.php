<?php    
    
    session_id("NireSesioa1");
    session_start();

    $actual_session_id = session_id();

    if(isset($_POST["loginbutton"])){
        $_SESSION["user"] = $_POST["user"];
        $_SESSION["pass"] = $_POST["pass"];
    }

    if(isset($_POST["logoutbutton"])){
        session_destroy();
    }

    include_once('vista.html');

?>