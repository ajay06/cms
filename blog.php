<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>


<!DOCTYPE>

<html>
    <head>
        <title>Admin Dashboard</title>
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

                                <form action="blog.php" class="navbar-form navbar-right">
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

                             <?php

                                global $conn;

                                if(isset($_GET["SearchButton"])){

                                        //when seach button is active

                                        $Search = $_GET["Search"];
                                        $ViewQuery= "SELECT * FROM admin_panel 
                                        WHERE post LIKE '%$Search%'  OR title LIKE '%$Search%' " ;
                                
                                }elseif(isset($_GET["category"])){

                                        //Query based on category selection

                                        $Category=$_GET["category"];
                                        $ViewQuery="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY datetime desc";
                                }elseif(isset($_GET["Page"])){


                                    //pagination Algorithm when pagination is active

                                    $Page=$_GET["Page"];

                                    


                                    $ShowPostFrom=($Page*5)-5;

                                    echo $ShowPostFrom;




                                    $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $ShowPostFrom,5";



                                }
                                
                                
                                else{


                                         $ViewQuery ="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,3";
                                        }

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

                                                    if(strlen($post)>50){

                                                        $post=substr($post,0,150).'....';
                                                    }
                                        
                                                    echo htmlentities($post) ?></p>
                                    </div>

                                    <a href="full_post.php?id=<?php echo $postid ; ?>"<span class="btn btn-info ">Read More &rsaquo; &rsaquo;</span></a>


                             </div>

                            

                             <?php
                                
                                 }
                             
                             ?>

                            
                            
                            <ul class="pagination pagination-lg">

                            <?php
                            
                            global $conn;
                            $result=mysqli_query($conn,"SELECT COUNT(*) as total FROM admin_panel");
                            $totalpost=mysqli_fetch_assoc($result);
                            $no_of_post= $totalpost['total'];

                           //echo($totalpost['total']);


                            $PostPerPage= $no_of_post/5;
                         
                            $PostPerPage=ceil($PostPerPage);

                          //  echo $PostPerPage;


                            for($i=1 ; $i<=$PostPerPage;$i++){

                                if(isset($Page)){
                                if($i== $Page){


                            ?>
                            

                               <li class="active"><a href="blog.php?Page=<?php echo $i; ?>"><?php echo $i;?></a></li>
                               
                             
                             <?php
                                }
                            

                                else{


                            ?>

                                 <li><a href="blog.php?Page=<?php echo $i; ?>"><?php echo $i;?></a></li>
                                    
                            <?php

                                }

                            }
                            
                             
                            }
                             ?>
                            
                            </ul>
                            
                             











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