<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>

<?php


    $_SESSION["User_id"]=null;
    session_destroy();
    Redirect_to("Login.php");




?>