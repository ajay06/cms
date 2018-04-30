<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>

<?php 

if(isset($_POST["Submit"])) {

    $username=$_POST["user"];
    $password=$_POST["pass"];
    

    if(empty($username) || empty($password)){

        $_SESSION["ErrorMessage"]="All field must be filled out" ;
        //echo "All field must be filled out";

        
        //header("Location:dashboard.php");
        Redirect_to("login.php");
        exit;

    } else{

        
            $Found_Account=Login_Attempt($username,$password);
           // $Execute=mysqli_query($conn,$Query);

            if($Found_Account){

                $_SESSION["User_id"]=$Found_Account["id"];
                $_SESSION["Username"]=$Found_Account["username"];
                
                $_SESSION["SuccessMessage"]="Login Successfully {$_SESSION["Username"]}";
                    //header("Location:categories.php");
                   Redirect_to("dashboard.php");

            }else{

                
               $_SESSION["ErrorMessage"]="Something went wrong failed to login";
               Redirect_to("login.php?error=0");
            }
                
                
            

    }

    




}


?>

<!DOCTYPE>

<html>
    <head>
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/adminstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
    
                .FieldInfo{

                    color: #6666ff;
                    font-family: Bitter,Georgia, 'Times New Roman', Times, serif;
                    font-size: 20px;
                }

                body{

                    background:#ffffff;
                }
         </style>
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                    
                    

                    <div class="col-sm-offset-4 col-sm-4">

                        <br><br><br><br><br><br><br><br>
                        <!-- error or success message display after adding category-->
                        <div> <?php echo ErrorMessage(); 
                                    echo SuccessMessage();
                        ?></div><!--end of message-->

                        
                        <h2>Welcome Back !</h2>
                        
                        
                        
                        <div >
                        <form action="login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                <label for="username"><span class="FieldInfo"> Username</span></label>
                                <input class="form-control" type="text" name="user" id="username" placeholder="Username">
                               </div>

                               <div class="form-group">
                                <label for="password"><span class="FieldInfo"> Password</span></label>
                                <input class="form-control" type="password" name="pass" id="password" placeholder="Password">
                               </div>
                               <br>


                               
                               <input class="btn btn-info btn-block" style="height:50px"   type="Submit" name="Submit" value="Login">
                           </fieldset>
                            
                        </form>
                    </div>

    
                    
                    
                   
                            

                </div><!--end of main content -->
                   
                
                
            </div><!--end of row-->
          
        </div><!-- End of cotainer fluid-->

        
        
    </body>
</html>