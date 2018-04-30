<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>


<?php

    if(isset($_GET["id"])){

        $IdFromURL=$_GET["id"];
        global $conn;

        $Query= "UPDATE comments SET status='OFF'
                WHERE id='$IdFromURL'";

        $Execute=mysqli_query($conn,$Query);

        if($Execute){
                $_SESSION["SuccessMessage"]="DisApproved Successfully";
                //header("Location:categories.php");
                Redirect_to("comments.php");

         }else{
                $_SESSION["ErrorMessage"]="Something went wrong";
                Redirect_to("comments.php");
    }

    }

?>