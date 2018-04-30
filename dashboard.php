<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_login(); ?>


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

                                    <form action="full_blog.php" class="navbar-form navbar-right">
                                                <div class="form-group">
                                                    <input type="text"  class="form-control" placeholder="Search" name="Search">
                                                
                                                </div>
                                                <button class="btn btn-default" name="SearchButton">Go</button>
                                    </form>
                        </div>





                </div>
            </nav>  <!-- End of Navbar-->
            <div class="line" style="height: 10px ;background: #27aae1;"></div>            





        <div class="container-fluid">
            <div class="row">
                    
                    <div class="col-sm-2">
                        <h1>LOgo</h1>

                        <ul id="Side_Menu" class="nav nav-pills nav-stacked">

                            <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp; &nbsp;Dashboard</a></li>
                            <li><a href="add_new_post.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add new post</a></span></li>
                            <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; &nbsp;Categories</a></li>
                            <li><a href="manage_admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp; &nbsp;Manage Admins</a></li>
                            <li>
                                    <a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp; &nbsp;Comments
                            
                                        <?php

                                                $result=mysqli_query($conn,"SELECT COUNT(*) as total FROM comments WHERE  status='OFF'");
                                                $not_approved=mysqli_fetch_assoc($result);
                                                $not_approvedTotal= $not_approved['total'];

                                                if($not_approved['total']>0)
                                                    {



                                                ?>



                                                <span class="label pull-right label-warning"><?php echo $not_approved['total'] ;?> </span>

                                                <?php
                                                    }
                                                ?>
                                    </a>
                            
                            </li>
                            <li><a href="blog.php"><span class="glyphicon glyphicon-picture"></span>&nbsp; &nbsp;Live Blog</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp; &nbsp;Logout</a></li>

                        </ul>

                    </div><!--End of right portion-->

                    <div class="col-sm-10"> <!--MAin Area-->
                        
                        <div> <?php echo ErrorMessage(); 
                                    echo SuccessMessage(); ?>
                        </div>

                        <h1>Admin Dashboard</h1>

                        <div class="responsive">
                                <table class="table table-striped table-hover">
                                        <tr>

                                                <th>No</th>
                                                <th>Post Title</th>
                                                <th>Date & Time</th>
                                                <th>Author</th>
                                                <th>Category</th>
                                                <th>Banner</th>
                                                <th>Comments</th>
                                                <th>Action</th>
                                                <th>Details</th>

                                        </tr>

                                        <?php

                                            global $conn;
                                            $ViewQuery= "SELECT * FROM admin_panel ORDER BY datetime DESC";
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

                                        <tr>

                                                <td><?php echo htmlentities($postid); ?></td>
                                                <td><?php echo htmlentities($title); ?></td>
                                                <td><?php echo htmlentities($datetime); ?></td>
                                                <td><?php echo htmlentities($author); ?></td>
                                                <td><?php echo htmlentities($category); ?></td>
                                                <td><img src="uploads/<?php echo $image ?>" width="170px" height="50px"></td>
                                                <td>
                                                
                                                <?php

                                                    $result=mysqli_query($conn,"SELECT COUNT(*) as total FROM comments WHERE admin_panel_id='$postid' AND status='OFF'");
                                                    $not_approved=mysqli_fetch_assoc($result);
                                                    $not_approvedTotal= $not_approved['total'];

                                                    if($not_approved['total']>0)
                                                        {
                                                
                                                

                                                ?>

                                                

                                                <span class="label pull-left label-danger"><?php echo $not_approved['total'] ;?> </span>

                                                <?php
                                                 }
                                                ?>


                                                <?php 

                                                    $result=mysqli_query($conn,"SELECT COUNT(*) as total FROM comments WHERE admin_panel_id='$postid' AND status='ON'");
                                                    $approved=mysqli_fetch_assoc($result);
                                                    $approvedTotal= $approved['total'];


                                                    if($not_approved['total']>0)
                                                    {
                                            
                                                                                                    
                                                
                                                ?>


                                                <span class="label pull-right label-success"><?php echo $approved['total'] ;?> </span>

                                                <?php 
                                                
                                                    }

                                                ?>
                                                
                                                </td>
                                                <td>
                                                <a class="btn btn-success" href="edit_post.php?Edit=<?php echo $postid; ?>">Edit</a>&nbsp;&nbsp;    <a class="btn btn-danger" href="delete_post.php?Delete=<?php echo $postid; ?>" >Delete</a>   
                                                </td>
                                                <td>
                                                    <a href ="full_post.php?id=<?php echo $postid ?>" target="_blank" >
                                                        <span class="btn btn-primary" >Live Preview</span>
                                                    </a>
                                                </td>

                                        </tr>

                                        <?php
                                                }
                                        ?>


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