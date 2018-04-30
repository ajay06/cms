<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>


<?php


function Redirect_to($New_Location){
    echo $New_Location;

    header("Location:".$New_Location);
    exit;
    

}

function Login_Attempt($Username,$Password){

    global $conn;
    $Query = "SELECT * FROM registration WHERE username='$Username' AND password='$Password'";

    $Execute=mysqli_query($conn,$Query);

    if($admin= mysqli_fetch_assoc($Execute)){

        return $admin;
    }else{

        return null;
    }



}


function Login(){


    if(isset($_SESSION["User_id"])){

        return true;
    }
}


function Confirm_login(){

    if(!Login()){
        $_SESSION["ErrorMessage"]="Login Required";

        Redirect_to("Login.php");
    }


}




?>