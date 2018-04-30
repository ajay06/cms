<?php require_once("include/conn.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php Confirm_login(); ?>

<!DOCTYPE>

<html>
    <head>
        <title>Comments</title>
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

                            <li ><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp; &nbsp;Dashboard</a></li>
                            <li><a href="add_new_post.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add new post</a></span></li>
                            <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; &nbsp;Categories</a></li>
                            <li><a href="manage_admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp; &nbsp;Manage Admins</a></li>
                            <li class="active"><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp; &nbsp;Comments</a></li>
                            <li><a href="live_blog.php"><span class="glyphicon glyphicon-picture"></span>&nbsp; &nbsp;Live Blog</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp; &nbsp;Logout</a></li>

                        </ul>

                    </div><!--End of right portion-->

                    <div class="col-sm-10"> <!--MAin Area-->
                        
                        <div> <?php echo ErrorMessage(); 
                                    echo SuccessMessage(); ?>
                        </div>

                        <h1>UnApproved Comments</h1>

                        <div class="responsive">
                                <table class="table table-striped table-hover">
                                        <tr>

                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Comment</th>
                                                <th>Approve</th>
                                                <th>Delete Comment</th>
                                                <th>Details</th>

                                        </tr>

                                        <?php

                                            global $conn;
                                            $ViewQuery= "SELECT * FROM comments WHERE status='OFF'";
                                            $Execute=mysqli_query($conn,$ViewQuery);
                                            $Srno=0;
                                            while($DataRows=mysqli_fetch_array($Execute)){

                                                $CommentId=$DataRows["id"];
                                                $Datetime=$DataRows["datetime"];
                                                $PersonName=$DataRows["name"];
                                                $Personcomment=$DataRows["comment"];
                                                
                                                $CommentPostId=$DataRows["admin_panel_id"];
                                                
                                                $Srno++;
                                                
                                                    

                                            

                                        ?>

                                        <tr>

                                                <td><?php echo htmlentities($Srno); ?></td>
                                                <td style="color:#5e5eff;"><?php echo htmlentities($PersonName); ?></td>
                                                <td><?php echo htmlentities($Datetime); ?></td>
                                                <td><?php echo htmlentities($Personcomment); ?></td>
                                                
                                                <td><a href="approve_comment.php?id=<?php echo $CommentId ?>"><span class="btn btn-success">Approve</span></a></td>
                                                <td><a href="delete_comment.php?id=<?php echo $CommentId ?>"><span class="btn btn-danger">Delete</span></a></td>
                                                <td><a href="full_post.php?id=<?php echo $CommentPostId ?>"><span class="btn btn-primary">Live Preview</span></a></td>

                                        </tr>

                                        <?php
                                                }
                                        ?>


                                </table>
                        </div>

                        <h1>Approved Comments</h1>

                                <div class="responsive">
                                        <table class="table table-striped table-hover">
                                                <tr>

                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Comment</th>
                                                        <th>Approved by</th>
                                                        <th>DisApprove</th>
                                                        
                                                        <th>Delete Comment</th>
                                                        <th>Details</th>

                                                </tr>

                                                <?php

                                                    global $conn;
                                                    $ViewQuery= "SELECT * FROM comments WHERE status='ON'";
                                                    $Execute=mysqli_query($conn,$ViewQuery);
                                                    $Srno=0;

                                                    
                                                    while($DataRows=mysqli_fetch_array($Execute)){

                                                        $CommentId=$DataRows["id"];
                                                        $Datetime=$DataRows["datetime"];
                                                        $PersonName=$DataRows["name"];
                                                        $Personcomment=$DataRows["comment"];
                                                        $CommentPostId=$DataRows["admin_panel_id"];
                                                        $Approved_by=$DataRows["approvedby"];

                                                        
                                                        $Srno++;

                                                    

                                                ?>

                                                <tr>

                                                        <td><?php echo htmlentities($Srno); ?></td>
                                                        <td style="color:#5e5eff;"><?php echo htmlentities($PersonName); ?></td>
                                                        <td><?php echo htmlentities($Datetime); ?></td>
                                                        <td><?php echo htmlentities($Personcomment); ?></td>
                                                        <td><?php echo htmlentities($Approved_by); ?></td>
                                                        
                                                        <td><a href="disapprove_comment.php?id=<?php echo $CommentId ?>"><span class="btn btn-warning">DisAprrove</span></a></td>
                                                        <td><a href="delete_comment.php?id=<?php echo $CommentId ?>"><span class="btn btn-danger">Delete</span></a></td>
                                                        <td><a href="full_post.php?id=<?php echo $CommentPostId ?>"><span class="btn btn-primary">Live Preview</span></a></td>

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