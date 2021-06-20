    <?php
    include("connection/connect.php");
    // include("header.php");
    include_once 'product-action.php';
    error_reporting(0);
    session_start();
    $i=0;
    $cart_total=0;
    if(empty($_SESSION["user_id"]))
    {
        header('location:login.php');
    } else 
    {			
        foreach ($_SESSION["cart_item"] as $item)
        {    
            (int)$item_total = ((int)$item["price"]*(int)$item["quantity"]);
            (int)$cart_total += $item_total;
        }							  
        foreach ($_SESSION["cart_item"] as $item)
        {
            (int)$item_total = ((int)$item["price"]*(int)$item["quantity"]);
            //(int)$cart_total += $item_total;
            if($_POST['submit'])
            {
                //if($_POST['mod'] === "COD")
                {
                    $user_id = $_SESSION["user_id"];
                    $user_name = $_SESSION["user_name"];
                    $food_name = $item["food_name"];
                    $qty = $item["quantity"];
                    $_SESSION['qty'] = $qty;
                    $status="Successful";
                    $_SESSION['food_name'] = $food_name;
                    date_default_timezone_set("Asia/Calcutta");
                    $addedon = date('Y-m-d h-m-s');
                    $SQL="insert into users_orders(u_id,food_name,quantity,price) values('$user_id','$food_name','$qty','$item_total')";
                    mysqli_query($db,$SQL);
                    $getordid = "select o_id from users_orders where u_id='$user_id'";
                    $getorderid = mysqli_query($db,$getordid);
                    $getorderid2 = mysqli_fetch_assoc($getorderid);
                    $order_id = $getorderid2['o_id'];
                    $query = "insert into payment(user_id,name,amount,type,status,ordered_id,added_on) values ('$user_id','$user_name','$cart_total','COD','$status','$order_id','$addedon')";
                    while($i<1)
                    {
                        $i++;
                        mysqli_query($db,$query);
                    }
                    unset($_SESSION["cart_item"]);
                    $success = "Thankyou! Your Order Placed successfully!";
                }
            }
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Online Food Ordering System</title>
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/jquery-3.6.0.js"></script>
        <script type="text/javascript" src="js/crypto-js.min.js"></script>
        <link rel="stylesheet" href="css/groupbtn.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: rgba(77,68,66,0.5);">
            <div class="container-fluid">
                <a class="navbar-brand" href="index32.php" style="margin-left: 20px;">
                    <div class="card" style="width: 50px;">
                        <img src="images/fast-food2.png" class="card-img-top" alt="...">
                    </div>
                </a>
                <a class="navbar-brand" href="index32.php" style="margin-left: 20px;">Food Point</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                            <a class="nav-link" href="dishes.php?flag=true">Cart(<?php if(isset($_SESSION["cart_item"])){echo count($_SESSION["cart_item"]);}else{echo "0";}?>)</a>
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
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" ';?>
                            onclick="location.href='logout.php'" <?php echo ' ">
                                    Log out
                                  </button>
                                  </div>
                                  </ul>
                                </div>';
                                      
                            }
                            ?>
                </div>
                </ul>
                </li>
                </ul>
            </div>
            </div>
        </nav>
        <div class="modal fade" id="custprofile" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Current Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="text" class="form-control" id="inputpassword" name="password">
                        </div>
                        <button type="button" class="btn btn-primary " onclick="checkpass()">Verify</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="verpass" data-bs-target="#custprofile2"
                            data-bs-toggle="modal" data-bs-dismiss="modal" disabled>Next</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="custprofile2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="profileform">
                            <fieldset disabled>
                                <div class="col-md-6">
                                    <label for="disabledTextInput" class="form-label">User ID</label>
                                    <input type="text" id="disabledTextInput" class="form-control"
                                        value="<?php echo $_SESSION['user_id'] ?>">
                                </div>
                            </fieldset>
                            <div class="col-md-6" style="margin-top: 1%;">
                                <label for="exampleFormControlInput1" class="form-label">User Name</label>
                                <input type="text" value="<?php echo $row["username"];?>" class="form-control"
                                    id="usernameid" name="username" placeholder="User Name">
                            </div>
                            <div class="row" style="margin-top: 1%;">
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">First Name</label>
                                    <input type="text" value="<?php echo $row["f_name"];?>" class="form-control"
                                        placeholder="First name" name="fname" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                                    <input type="text" value="<?php echo $row["l_name"];?>" class="form-control"
                                        placeholder="Last name" name="lname" aria-label="Last name">
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top: 1%;">
                                <label for="inputEmail4" class="form-label">Phone no.</label>
                                <input type="number" value="<?php echo $row["phone"];?>" class="form-control"
                                    id="inputEmail4" name="phno">
                            </div>
                            <div class="col-md-6" style="margin-top: 1%;">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" value="<?php echo $row["email"];?>" class="form-control"
                                    name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top: 1%;">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                            </div>
                            <div class="col-12" style="margin-top: 1%;">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" value="<?php echo $row["address"];?>"
                                    id="exampleFormControlTextarea1" name="address" rows="3"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="updateprofile" name="profilesubmit">Done</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="page-wrapper" style="margin: auto;">
            <!-- top Links -->
            <div class="groupbtn">
                <div class="btn-group">
                    <a href="#">
                        <button type="button" class="btn btn-outline-primary disabled"
                            style="border-radius: 50px 0 0 0;">
                            Pick Your favorite food
                        </button>
                    </a>
                    <a href="#">
                        <button type="button" class="btn btn-outline-primary disabled" style="border-radius: 0 0 0 0;">
                            Confirm Details
                        </button>
                    </a>
                    <a href="#">
                        <button type="button" class="btn btn-outline-primary active" style="border-radius: 0 0 50px 0;">
                            Order and Pay online
                        </button>
                    </a>
                </div>

            </div>

            <div class="container">
                <span style="color:green;"> <?php echo $success; ?> </span>
            </div>

            <div class="container m-t-30">
                <form action="" method="post">
                    <div class="widget clearfix">
                        <div class="widget-body">
                            <form method="post" action="" id="codform">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cart-totals margin-b-20">
                                            <div class="cart-totals-title">
                                                <h4>Cart Summary</h4>
                                            </div>
                                            <div class="cart-totals-fields">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Cart Subtotal</td>
                                                            <td> <?php echo "₹".$cart_total; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shipping &amp; Handling</td>
                                                            <td>free shipping</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-color"><strong>Total</strong></td>
                                                            <td class="text-color"><strong>
                                                                    <?php echo "₹".$cart_total; ?></strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--cart summary-->
                                        <input type="submit" onclick="return confirm('Are you sure?');" name="submit"
                                            id="codbtn" style="visibility: hidden; height: 0px;" class="btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form action="payment.php?checkout=manual" method="POST" name="nbform" id="netbankform">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
                        <input type="hidden" name="username" value="<?php echo $_SESSION["user_name"] ?>">
                        <input type="hidden" name="amount" value="<?php echo $cart_total ?>">
                        <input type="submit" name="submit1" value="Net Banking" id="netbanksub"
                            class="btn btn-outline-primary w-100">
                    </form>
                    <p style="margin-top: 1%;"> <input type="submit" onclick="cod()" name="submit"
                            class="btn btn-outline-success w-100" value="Cash on Delivery"> </p>
                </form>
            </div>



        </div>



        <script>
        function cod() {
            document.getElementById("codbtn").click();
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
    </body>

    </html>