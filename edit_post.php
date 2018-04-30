<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>

<?php 

if(isset($_POST["Submit"])) {

    $Title=$_POST["TITLE"];
    $Category=$_POST["CATEGORY"];
    $IMAGES=$_FILES["IMAGES"]["name"];
    $Post=$_POST["POSTS"];

    //SETTING THE TARGET FOR IMAGE TO SAVE
    $Target="uploads/".basename($_FILES["IMAGES"]["name"]);

    

    $currentTime=time();
    $DateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);

    $Admin="Ajay";

    if(empty($Title)){

        $_SESSION["ErrorMessage"]="Title can't be empty";
        //echo "All field must be filled out";

        
        //header("Location:dashboard.php");
        Redirect_to("add_new_post.php");
        exit;

    }elseif(strlen($Title)<2){

            $_SESSION["ErrorMessage"]="Title must be at-least 2 characters";
            Redirect_to("add_new_post.php");
        
    }elseif(empty($Category)){

        $_SESSION["ErrorMessage"]="Cat must be at-least 2 characters";
        Redirect_to("add_new_post.php");

    }elseif(empty($Post)){
        
                $_SESSION["ErrorMessage"]="post must be at-least 2 characters";
                Redirect_to("add_new_post.php");
        
    }else{



            global $conn;

            $EditfromUrl=$_GET["Edit"];

            $vQuery="UPDATE admin_panel SET datetime= '$DateTime', title='$Title', 
            category='$Category', author='$Admin', image='$IMAGES', post='$Post'
            WHERE id='$EditfromUrl'";

            $Execute=mysqli_query($conn,$vQuery);

            move_uploaded_file($_FILES["IMAGES"]["tmp_name"],$Target);


            if($Execute){
                    $_SESSION["SuccessMessage"]="Successfully updated post";
                    //header("Location:categories.php");
                    Redirect_to("dashboard.php");

            }else{
                    $_SESSION["ErrorMessage"]="Something went wrong Post failed to add ";
                    Redirect_to("dashboard.php");
            }
                
                
            

    }

    




}


?>

<!DOCTYPE>

<html>
    <head>
        <title>Edit Post</title>
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
                                        <li class="active"><a href="add_new_post.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add new post</a></span></li>
                                        <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; &nbsp;Categories</a></li>
                                        <li><a href="manage_admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp; &nbsp;Manage Admins</a></li>
                                        <li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp; &nbsp;Comments</a></li>
                                        <li><a href="live_blog.php"><span class="glyphicon glyphicon-picture"></span>&nbsp; &nbsp;Live Blog</a></li>
                                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp; &nbsp;Logout</a></li>

                                </ul>

                    </div><!--End of right portion-->

                    <div class="col-sm-10">
                            <h1>Update Post</h1>
                            
                            <!-- error or success message display after adding category-->
                            <div> <?php echo ErrorMessage(); 
                                        echo SuccessMessage();
                                        

                            ?></div><!--end of message-->
                            
                            <div >
                                        <?php

                                            $PostIDFromURL=$_GET["Edit"];

                                           
                                            $ViewQuery ="SELECT * FROM admin_panel
                                            WHERE id='$PostIDFromURL'  ORDER BY datetime desc";

                                            $Execute=mysqli_query($conn,$ViewQuery);

                                            while($DataRows=mysqli_fetch_array($Execute)){

                                            
                                        
                                            $CategoryToBeUpdated=$DataRows["category"];
                                            $TitleToBeUpdated=$DataRows["title"];
                                            $ImageToBeUpdated=$DataRows["image"];
                                            $PostToBeUpdated=$DataRows["post"];


                                            }         
                                        ?>


                                        <form action="edit_post.php?Edit=<?php echo $PostIDFromURL; ?>" method="post" enctype="multipart/form-data">
                                            <fieldset>

                                                    <div class="form-group">
                                                        <label for="title"><span class="FieldInfo">Title:</span></label>
                                                        <input value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="TITLE" id="title" placeholder="Title">
                                                    </div>
                                                    <span class="FieldInfo">Existing Category:</span>
                                                    <?php
                                                        echo $CategoryToBeUpdated;
                                                    ?>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="selectcategory"><span class="FieldInfo"> Select Category:</span></label>
                                                        <select class="form-control" type="text" name="CATEGORY" id="selectcategory" >
                                                            <?php
                                                            
                                                            global $con;
                                                            $VieQuery = "SELECT name from categories";

                                                            $Execute=mysqli_query($conn,$VieQuery);

                                                            while($DataRow=mysqli_fetch_array($Execute)){

                                                                $CategoryName=$DataRow[name];

                                                            

                                                            ?>

                                                            <option><?php echo $CategoryName; ?></option>

                                                            <?php } ?>

                                                            
                                                            </select>

                                                    </div>
                                                    
                                                    <span class="FieldInfo">Existing Image:</span>
                                                    <img src="uploads/<?php echo $ImageToBeUpdated;?>" height="50px" width="150px" >
                                                    <br>

                                                    <div class="form-group">
                                                        <label for="imageselect"><span class="FieldInfo"> Select Images:</span></label>
                                                        <input class="form-control" type="file" name="IMAGES" id="imageselect" >
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="postarea"><span class="FieldInfo">Post:</span></label>
                                                        <textarea  class="form-control" type="text" name="POSTS" id="postarea" placeholder="Write the post">
                                                        <?php echo $PostToBeUpdated; ?>
                                                        </textarea>
                                                        <br>
                                                    </div>

                                                   

                                                <input class="btn btn-success btn-block" style="height:50px"   type="Submit" name="Submit" value="Update Postt">
                                            </fieldset>
                                            
                                        </form>
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