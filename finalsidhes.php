<!DOCTYPE html>
<html lang="en">
<?php
    include("connection/connect.php"); // connection to db
    error_reporting(0);
    session_start();
    include_once 'product-action.php'; //including controller
    
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Online Food Ordering System</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="css/groupbtn.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: rgba(77,68,66,0.5);">
  <div class="container-fluid">
  <div class="card" style="width: 50px;">
  <img src="images/fast-food2.png" class="card-img-top" alt="...">
    </div>
    <a class="navbar-brand" href="index32.php" style="margin-left: 20px;">Food Point</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown" class="d-flex">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index32.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="restaurants.php">Restaurants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="your_orders.php">Your Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#footer">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
        <?php
                            if(empty($_SESSION["user_id"])) // if user is not login
                            {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
                                <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
                            } else {
                                //if user is login

                                echo  '<!-- Example split danger button -->
                                <div class="btn-group">
                                  <button type="button" class="btn btn-secondary">';
                                  echo ($_SESSION["user_name"]);
                                  
                                  echo '</button>
                                  <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                  </button>
                                  <ul class="dropdown-menu" style="margin-left:-60px; padding-left: 10px; padding-right: 10px; margin-top: 20px;">
                                    <div class="d-grid mx-auto">                                    
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#custprofile">
                                    Update profile
                                  </button>
                                    <hr class="dropdown-divider">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" ';?> onclick="location.href='logout.php'" <?php echo ' ">
                                    Log out
                                  </button>
                                  </div>
                                  </ul>
                                </div>';
                                $getpass = "select password from users where u_id='$user_id'";
                                $getpassresult=mysqli_query($db, $getpass); //executing
                                $row=mysqli_fetch_array($getpassresult);
                                $password = $row['password'];           
                            }
                            ?>
</div>  
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- top Links -->
            <div class="groupbtn">
								<div class="btn-group">
                                    <a href="restaurants.php">
                                        <button type="button" class="btn btn-outline-primary active" style="border-radius: 50px 0 0 0;">    
                                        Pick Your favorite food
                                        </button>
                                    </a> 
                                    <a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">
    								    <button type="button" class="btn btn-outline-primary" style="border-radius: 0 0 0 0;">
                                            Confirm Address
                                        </button>
                                    </a>
                                    <a href="#">
								        <button type="button" class="btn btn-outline-primary" style="border-radius: 0 0 50px 0;">
                                            Order and Pay online
                                        </button>								
                                    </a>
                                </div>

            </div>
            <!-- end:Top links -->
        </div>


        <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
  Link with href
</a>
            
        <table class="table">
  <thead class="table-light">
  <tr>
      <th scope="col">#</th>
      <th scope="col">Food Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
    <tbody>
        <?php
            $item_total = 0;
            foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
            {
                ?>
                <tr>
                    <th scope="row">1</th>
                    <td><?php echo $item["food_name"]; ?></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td><?php echo "₹".$item["price"]; ?></td>
                    <td><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" >asdf</td>
                </tr>
                <?php
                $item_total += ($item["price"]*$item["quantity"]); // calculating current price into cart
            }
        ?>
        <tr><td></td><td></td><td></td>
        <td><?php echo "₹".$item_total; ?></td>
        </tr>
    </tbody>
</table>

====================================================================

<!-- start: Inner page hero -->
<?php 
                $ress= mysqli_query($db,"select * from restaurant where rs_id='$_GET[res_id]'");
                $rows=mysqli_fetch_array($ress);										  
            ?>

            <section class="inner-page-hero bg-image" data-image-src="images/img/dish.jpeg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/Res_img/'.$rows['mage'].'" alt="Restaurant logo">'; ?></figure>
                                </div>
                            </div>
							
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['fodd_name']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>
                                    <ul class="nav nav-inline">
                                        <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min  ₹99.00</a> </li>
                                        <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> 30 min</a> </li>
                                        <li class="nav-item ratings">
                                            <a class="nav-link" href="#"> 
                                                <span>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </span> 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end:Inner page hero -->
            <div class="breadcrumb">
                <div class="container">
                   
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">                        
                        <div class="widget widget-cart">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark"> Your Order Cart </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">
	                            <?php
                                    $item_total = 0;
                                    foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
                                    {
                                ?>
                                    <div class="title-row">
										<?php echo $item["food_name"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>" >
										<i class="fa fa-trash pull-right"></i></a>
									</div>
										
                                    <div class="form-group row no-gutter">
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control b-r-0" value=<?php echo "₹".$item["price"]; ?> readonly id="exampleSelect1">                                                   
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
									    </div>
                                <?php
                                    $item_total += ($item["price"]*$item["quantity"]); // calculating current price into cart
                                    }
                                ?>
                            </div>
                        </div>
                               
                        <!-- end:Order row -->
                        
                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>TOTAL</p>
                                <h3 class="value"><strong><?php echo "₹".$item_total; ?></strong></h3>
                                <p>Free Shipping</p>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn theme-btn btn-lg">Checkout</a>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">                      
                        <!-- end:Widget menu -->
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    POPULAR ORDERS Delicious hot food! 
                                    <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        <i class="fa fa-angle-down pull-right"></i>
                                    </a>
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <!-- <div class="collapse in" id="popular2"> -->
                                <?php  
                                    // display values and item of food/dishes
									$stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									    foreach($products as $product){
								?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
										<form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?></a>
                                            </div>
                                            <!-- end:Logo -->
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['food_name']; ?></a></h6>
                                                <p> <?php echo $product['slogan']; ?></p>
                                            </div>
                                            <!-- end:Description -->
                                        </div>
                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> 
										<span class="price pull-left" >₹<?php echo $product['price']; ?></span>
										  <input class="b-r-0.5" type="text" name="quantity"  style="margin-left:30px;" value="1" size="2" />
										  <input type="submit" class="btn theme-btn" style="margin-left:10px; margin-top:15%; radius:35%;" value="Add to cart" />
										</div>
										</form>
                                    </div>
                                    <!-- end:row -->
                                </div>
                                <!-- end:Food item -->
								
								<?php
									    }
									}
								?>
                            <!-- </div> -->
                            <!-- end:Collapse -->
                        </div>
                        <!-- end:Widget menu -->                       
                    </div>
                    <!-- end:Bar -->
                            
                        </div>
                        </div>
                    </div>
                    <!-- end:Right Sidebar -->
                </div>
                <!-- end:row -->
            </div>
            <!-- end:Container -->


======================================================================



<div class="offcanvas offcanvas-start" tabindex="-1" style="width: 40%;" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php 
        // fetch records from database to display popular first 3 dishes from table
        $query_res= mysqli_query($db,"select * from restaurant"); 
        while($r=mysqli_fetch_array($query_res))
        {	
            echo '<div class="col-sm-8" style="margin: auto;height: 450px;">
                <div class="card" style="margin: auto; height: 90%;">
                <img src="admin/Res_img/'.$r['image'].'" class="card-img-top" alt="..." style="height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">'.$r['title'].'</h5>
                    <p class="card-text">'.$r['address'].'</p>
                    <a href="dishes.php?res_id='.$r['rs_id'].'" class="btn btn-primary">Add to cart</a>
                    <form action="" method="POST" id="myForm">
                        <input type="hidden" name="rsid" value="'.$r['rs_id'].'">
                        <input type="submit" name="submit" id="formbtn">
                    <button class="btn btn-primary" type="button" onclick="updatefoodquery()" id="canvasbtn" value="dishes.php?res_id='.$r['rs_id'].'" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>
                    <button class="btn btn-primary" type="button" id="secondcanvasbtn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">new</button>
                    <button type="button" onclick="right()">asdf</button>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</div>

<script>
    
    function updatefoodquery(a){
        document.getElementById('secondcanvasbtn').click();
        
    }
    function right(){
        document.getElementById("formbtn").click();

    }
</script>

<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>

<div class="offcanvas offcanvas-end" style="width: 50%;" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Offcanvas right</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <?php 
        // fetch records from database to display popular first 3 dishes from table
        $query_res= mysqli_query($db,"select * from dishes"); 
        while($rfood=mysqli_fetch_array($query_res))
        {
            echo '<div class="col-sm-5" style="margin: auto;height: 450px;">
                <div class="card" style="margin: auto; height: 90%;">
                <img src="admin/Res_img/dishes/'.$rfood['img'].'" class="card-img-top" alt="..." style="height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">'.$rfood['food_name'].'</h5>
                    <p class="card-text">'.$rfood['price'].'</p>
                    <a href="dishes.php?res_id='.$rfood['rs_id'].'" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>';
        }
        ?>
  </div>
</div>



<script>
    function primary(){
        $("#content").prop('disabled', true);
    }
    function secondary(){
        $("#content").prop('disabled', false);
    }
</script>
     <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>

<?php
if(isset($_POST['submit']))
{
    $frmid = $_POST['rsid'];
    echo $frmid,$frmid;
    // echo '<script>alert("asdf")</script>';
    echo '<script>updatefoodquery();</script>';
    
}

?>