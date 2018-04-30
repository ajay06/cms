<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>

    <?php

        if(isset($_POST["Submit"])) {

        $Name=$_POST["Name"];
        $Email=$_POST["Email"];
        $Comment=$_POST["Comment"];

        $PostId=$_GET["id"];



        $currentTime=time();
        $DateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);

        $Admin="Ajay";

        if(empty($Name)){

            $_SESSION["ErrorMessage"]="Name can't be empty";
            //echo "All field must be filled out";

            
            //header("Location:dashboard.php");
            Redirect_to("add_new_post.php");
            exit;

        }elseif(strlen($Name)<2){

                $_SESSION["ErrorMessage"]="Name must be at-least 2 characters";
                Redirect_to("add_new_post.php");
            
        }elseif(empty($Email)){

            $_SESSION["ErrorMessage"]="Email must be at-least 2 characters";
            Redirect_to("add_new_post.php");

        }elseif(empty($Comment)){
            
                    $_SESSION["ErrorMessage"]="Comment must be at-least 2 characters";
                    Redirect_to("add_new_post.php");
            
        }else{



                global $conn;

                

                $vQuery="INSERT INTO comments (datetime,name,email,comment,status,admin_panel_id)
                VALUES('$DateTime','$Name','$Email','$Comment','OFF',$PostId) ";

                $Execute=mysqli_query($conn,$vQuery);

                


                if($Execute){
                        $_SESSION["SuccessMessage"]="Posy Added Successfully";
                        //header("Location:categories.php");
                        Redirect_to("full_post.php?id={$PostId}");

                }else{
                        $_SESSION["ErrorMessage"]="Something went wrong Post failed to add ";
                        Redirect_to("full_post.php?id={$PostId}");
                }
                    
                    
                

        }






        }

    ?>



<!DOCTYPE>

<html>
    <head>
        <title>Blog Page</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
      
        <link rel="stylesheet" href="css/blogstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
                    #aj{

                        display: inline;
                        margin-top: -15px;

                    }

                    #ay{
                        display: inline;
                        margin-top: -15px;
                    }
                    .navbar-nav li{

                                font-weight: bold;
                                font-family: Bitter,Georgia, 'Times New Roman', Times, serif;
                                font-size: 1.2em;
                            }

                    .FieldInfo{

                                color: #ffb900;
                                font-family: Bitter,Georgia, 'Times New Roman', Times, serif;
                                font-size: 20px;
                                }




                    
        </style>
    </head>
    <body>

        <div style="height: 10px ;background: #27aae1;"></div>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container">
                    <div class="navbar-header" >
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                         data-target="#collapse">
                                        <span class="sr-only">Toggle Navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                            </button>

                            <a class="navbar-brand" href="blog.php">
                                    <img id="aj" src="images/wolf.png" width="80" height="50">
                                    <img id="ay" src="images/2.png" width="120" height="40">
                            </a>
                            
                    </div>

                    <div class="collapse navbar-collapse" id="collapse">
                                <ul class="nav navbar-nav  ">

                                        <li><a href="#">Home</a></li>
                                        <li class="active"><a href="blog.php">Blog</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Services</a></li>
                                        <li><a href="#">Contact</a></li>
                                        <li><a href="#">Feature</a></li>
                                        
                                        

                                </ul>

                                <form action="full_blog.php" class="navbar-form navbar-right">
                                            <div class="form-group">
                                                <input type="text"  class="form-control" placeholder="Search" name="Search">
                                            
                                            </div>
                                            <button class="btn btn-default" name="SearchButton">Go</button>
                                </form>
                     </div>





            </div>
        </nav>
        <div class="line" style="height: 10px ;background: #27aae1;"></div>


        <div class="container">

            <div class="blog-header"> 
                <h1>The Complete Responsive CMS Blog</h1>
                <p class="lead">The Complete blog using PHP by RASS</p>
            </div>

            <div class="row">

                    

                    <div class="col-sm-8"> <!--MAIN BLOG AREA-->

                            <!-- error or success message display after adding category-->
                            <div> <?php echo ErrorMessage(); 
                                                echo SuccessMessage();
                                                

                                    ?>
                            </div><!--end of message-->

                             <?php

                                global $conn;

                                if(isset($_GET["SearchButton"])){

                                        $Search = $_GET["Search"];
                                        $ViewQuery= "SELECT * FROM admin_panel 
                                        WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search% OR
                                        category LIKE '%$Search%' OR post LIKE '%$Search%' ";
                                
                                }else{

                                         $PostIDFromURL=$_GET["id"];
                                         $ViewQuery ="SELECT * FROM admin_panel
                                         WHERE id='$PostIDFromURL'  ORDER BY datetime desc";}

                                $Execute=mysqli_query($conn,$ViewQuery);

                                while($DataRows=mysqli_fetch_array($Execute)){

                                    $postid=$DataRows["id"];
                                    $datetime=$DataRows["datetime"];
                                    $category=$DataRows["category"];
                                    $title=$DataRows["title"];
                                    $author=$DataRows["author"];
                                    $image=$DataRows["image"];
                                    $post=$DataRows["post"];
                                

                             ?>

                             <div class="blogpost thumbnail">
                                   
                                    <img class="img-responsive img-rounded" src="uploads/<?php echo $image ?>">
                                    
                                    <div class="caption">
                                    
                                        <h1 id="heading"> <?php echo htmlentities($title); ?></h1>
                                        
                                        <p class"description">Category: <?php echo htmlentities($category) ?> Published on
                                            <?php echo htmlentities($datetime) ?> 
                                        </p>

                                        <p class="post"><?php 

                                                    echo nl2br($post) ?></p>
                                        <?php
                                            echo 'Current PHP version: ' . phpversion();
                                         ?>
                                    </div>

                                    


                             </div>

                            

                             <?php
                                
                                 }
                             
                             ?>
                            <br>
                             <span class="FieldInfo">Comments</span>

                             <?php
                             
                                    global $conn;

                                    $PostidforComments=$_GET["id"];

                                    $CommetQuery="SELECT * FROM comments
                                    WHERE admin_panel_id = '$PostidforComments' AND status='ON'";
                                    $Execute=mysqli_query($conn,$CommetQuery) ;

                                    while($DataRows=mysqli_fetch_array($Execute)){

                                        $CommentDate=$DataRows["datetime"];
                                        $CommenterName=$DataRows["name"];
                                        $Comments=$DataRows["comment"];
                                    

                             ?>

                             <div>
                                        <img class="pull-left" src="images/user.png" height=70px; width=100px; >
                                        <p><?php echo $CommenterName; ?> </p>
                                        <p><?php echo $CommentDate; ?> </p>
                                        <p><?php echo $Comments; ?> </p>

                             </div>
                             <br>
                             <hr>

                                    <?php 
                                            }
                                    ?>

                                <br><br>
                             <span class="FieldInfo " align="center">Share your thoughts about this post</span>
                                    <br>
                             


                             <div >
                                        <form action="full_post.php?id=<?php echo $PostIDFromURL; ?>" method="post" enctype="multipart/form-data">
                                            <fieldset>

                                                    <div class="form-group">
                                                        <label for="name"><span class="FieldInfo">Name:</span></label>
                                                        <input class="form-control" type="text" name="Name" id="name" placeholder="Name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email"><span class="FieldInfo">Email:</span></label>
                                                        <input class="form-control" type="text" name="Email" id="email" placeholder="Email">
                                                    </div>

                                                    

                                                    

                                                    <div class="form-group">
                                                        <label for="comment"><span class="FieldInfo">Comment:</span></label>
                                                        <textarea class="form-control" type="text" name="Comment" id="comment" placeholder="Write the post"></textarea>
                                                        <br>
                                                    </div>

                                                    


                                                
                                                

                                                <input class="btn btn-warning btn-block" style="height:50px"   type="Submit" name="Submit" value="Submit">
                                            </fieldset>
                                            
                                        </form>
                            </div>



                             





                    </div> <!--End of main content-->


                    <div class= "col-sm-offset-1 col-sm-3">

                           <h2>About Us</h2>
                            <img class="img-responsive img-circle imageicon" src="images/mon.jpg">
                            <br>
                            <p> Lorem ipsum dolor sit amet, usu ne eius ancillae, aeque putent est ex. Velit nonumy posidonium ea pri. Recusabo petentium consequuntur et pro. Mei graeci fabellas recteque in, mea at dico aeterno gloriatur, his vitae tacimates salutandi ut. Mundi labitur offendit eam id.
                            </p> 

                            <!-- panel-->
                            
                            <div class="panel panel-primary"> 
                                    <div class="panel-heading ">
                                            <h2 class="panel-title">Category</h2>

                                    </div>
                                    
                                    <div class="panel-body">

                                    <?php
                                           
                                           global $conn;

                                           $QueryCategory="SELECT * FROM categories";

                                           $Execute=mysqli_query($conn,$QueryCategory);

                                           while($DataRows=mysqli_fetch_array($Execute)){

                                                    $Id= $DataRows["id"];
                                                    
                                                    $Category=$DataRows["name"];
                                                   

                                           
                                    
                                    ?>
                                        
                                        <a href="blog.php?category=<?php echo $Category ?>">
                                            <span id="heading"><?php echo $Category; ?></span>
                                         </a> 
                                        <br>

                                    <?php 
                                        } 
                                    ?>
                                    </div>

                                    <div class="panel-footer">
                            
                                    </div>
                             </div> <!--end of category panel-->


                             <div class="panel panel-primary"> 
                                    <div class="panel-heading ">
                                            <h2 class="panel-title">Categories</h2>

                                    </div>

                                    <div class="panel-body">
                                            Dummy content
                                    </div>

                                    <div class="panel-footer">
                            
                                    </div>
                             </div> <!-- end of recent panel-->

                            

                    </div> <!--Side Area Ending -->


            </div> <!--Ending of Row-->
            


        </div> <!--Ending of container-->






        



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