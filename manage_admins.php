<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_login(); ?>

<?php 

if(isset($_POST["Submit"])) {

    $username=$_POST["user"];
    $password=$_POST["pass"];
    $cpassword=$_POST["cpass"];


    

    $currentTime=time();
    $DateTime=strftime("%B-%d-%y %H:%M:%S",$currentTime);

    $Admin=$_SESSION["Username"];

    if(empty($username)){

        $_SESSION["ErrorMessage"]="All field must be filled out";
        //echo "All field must be filled out";

        
        //header("Location:dashboard.php");
        Redirect_to("manage_admins.php");
        exit;

    }elseif(strlen($username)>20){

            $_SESSION["ErrorMessage"]="Too long username";
            Redirect_to("manage_admins.php");
            exit;

        
    }elseif($password !== $cpassword){


            $_SESSION["ErrorMessage"]="Password does not match";
            Redirect_to("manage_admins.php");
            exit;


        



    } else{

            global $conn;
            $Query="INSERT INTO registration(datetime,username,password,addedby)
            VALUES('$DateTime','$username','$password','$Admin') ";

            $Execute=mysqli_query($conn,$Query);

            if($Execute){
                    $_SESSION["SuccessMessage"]="Admin Added Successfully";
                    //header("Location:categories.php");
                    Redirect_to("categories.php");

            }else{
                $_SESSION["ErrorMessage"]="Something went wrong failed to add";
                Redirect_to("manage_admins.php");
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
         </style>
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                    
                    <div class="col-sm-2">
                        <h1>LOgo</h1>

                        <ul id="Side_Menu" class="nav nav-pills nav-stacked">

                            <li ><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp; &nbsp;Dashboard</a></li>
                            <li><a href="add_new_post.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add new post</a></span></li>
                            <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; &nbsp;Categories</a></li>
                            <li class="active"><a href="manage_admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp; &nbsp;Manage Admins</a></li>
                            <li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp; &nbsp;Comments</a></li>
                            <li><a href="live_blog.php"><span class="glyphicon glyphicon-picture"></span>&nbsp; &nbsp;Live Blog</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp; &nbsp;Logout</a></li>

                        </ul>

                    </div><!--End of right portion-->

                    <div class="col-sm-10">
                        <h1>Manage Admin Access</h1>
                        
                        <!-- error or success message display after adding category-->
                        <div> <?php echo ErrorMessage(); 
                                    echo SuccessMessage();
                        ?></div><!--end of message-->
                        
                        <div >
                        <form action="manage_admins.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                <label for="username"><span class="FieldInfo"> Username</span></label>
                                <input class="form-control" type="text" name="user" id="username" placeholder="Username">
                               </div>

                               <div class="form-group">
                                <label for="password"><span class="FieldInfo"> Password</span></label>
                                <input class="form-control" type="password" name="pass" id="password" placeholder="Password">
                               </div>

                               <div class="form-group">
                                <label for="cnfpassword"><span class="FieldInfo"> Comfirm Password</span></label>
                                <input class="form-control" type="password" name="cpass" id="cnfpassword" placeholder="Confirm Password">
                               </div>

                               
                               <input class="btn btn-success btn-block" style="height:50px"   type="Submit" name="Submit" value="Add new Admin">
                           </fieldset>
                            
                        </form>
                    </div>

    
                    
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr class="warning">
                                <th>Sr No.</th>
                                <th>Date & Time</th>
                                <th>Username</th>
                                <th>Added by</th>
                                <th>Remove Admin</th>

                            </tr>

                            <!--- code for getting data from database-->
                            <?php

                                    global $conn;
                                    $ViewQuery ="SELECT * FROM registration ORDER BY datetime DESC";
                                    $Execute=mysqli_query($conn,$ViewQuery);
                                    $Srno=0;

                                    while($DataRows=mysqli_fetch_array($Execute)){

                                        $Id= $DataRows["id"];
                                        $DateTime=$DataRows["datetime"];
                                        $Name=$DataRows["username"];
                                        $Creator=$DataRows["addedby"];
                                        $Srno++;

                                    

                                    
                            ?>                            
                            
                            
                            <tr class="active">
                                <td><?php echo $Srno ?></td>    
                                <td><?php echo $DateTime ?></td>
                                <td><?php echo $Name ?></td>
                                <td><?php echo $Creator ?></td>
                                <td><a href="delete_admin.php?id=<?php echo $Id ?>"><span class="btn btn-danger">DELETE</span></a></td>
                                
                             </tr>   
                             
                           <?php } ?>  <!-- End of while loop and data extraction-->


                        </table>
                    </div>
                            

                </div><!--end of main content -->
                   
                
                
            </div><!--end of row-->
          
        </div><!-- End of cotainer fluid-->

        
        <div id="Footer">
            <hr> <p >Theme by | RASS Group | &copy; 2017 - 2018 ------All right reserved</p> 
        
            <p>
                This site is developed by RASS Group under the guidance of Dr. Sheetal Rathi.
            </p>
            <hr>
         </div>
         <div style="height: 10px; background: #27AAF1;"></div>
    </body>
</html>