<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();
include_once 'product-action.php'; //including controller
// include_once 'header.php';
$user_id = $_SESSION["user_id"];

$dishes = "select * from dishes";





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Food</title>
    <link rel="stylesheet" href="css/card.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script type="text/javascript" src="js/crypto-js.min.js"></script>
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- <link rel="stylesheet" href="css/searchbar.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/search.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: rgba(77,68,66,0.5);">
        <div class="container-fluid">
            <a class="navbar-brand" href="index32.php" style="margin-left: 20px; height: 50px;">
                <div style="width: 50px;height: 50px;">
                    <img src="images/fast-food2.png" class="card-img-top" alt="..." style="height: 50px;">
                </div>
            </a>
            <a class="navbar-brand" href="index32.php" style="margin-left: 20px;">Food Point</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown" class="d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="restaurants.php">Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dishes.php?flag=true">Cart</a>
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
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="custprofile" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
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
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Update Profile</h5>
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
                            <input type="email" value="<?php echo $row["email"];?>" class="form-control" name="email"
                                id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
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
    
    <div class="searchbar" style="margin:20px 40%;">
    <form method="post" name="form1" id="idform">
                            
                                    <input type="text" name="foodsearch" class="searchinput" 
                                        id="searchid" value="<?php echo $_POST['foodsearch']; ?>" autofocus>
                               
                            
                            <input type="submit" name="button1" value="Search" class="searchbtn"></input>
                        </form>
                        </div>
<div class="container" style="margin-top: 10px;">
<?php 
if(array_key_exists('button1', $_POST)) {
    button1($db);
}
function button1($db) {
                        // fetch records from database to display popular first 3 dishes from table
                        $dishid = "0";
                        $nsearch = $_POST['foodsearch'];

                                    $nsearch = mysqli_real_escape_string($db,$nsearch);
                                 //   $query_res= mysqli_query($db,"select * from dishes"); 
                                    $query_res= mysqli_query($db,"select * from dishes WHERE food_name LIKE '%".$nsearch."%'"); 
                        while($r=mysqli_fetch_array($query_res))
                        {	
                            $btn = "allfood.php?res_id=".$r['rs_id']."&action=add&id=".$r['d_id'];
                            ?>
                            <div class="card" style="width: 300px;">
                            <form action="<?php echo $btn; ?>" method="POST" name="<?php echo $r['d_id']; ?>">
                            <img src="admin/Res_img/dishes/<?php echo $r['img']; ?>" alt="Strawberry" class="img-fruit" style="height: 200px;" />
                            <h3><?php echo $r['food_name']; ?></h3>
                            <p><?php echo $r['slogan']; ?></p>
                            <div class="properties">
                            
                                <div class="qty">
                                    <h4>Quantity</h4>
                                    <input type="number" name="quantity" oninput="send(this.value, this.id)" onchange="send(this.value, this.id)" value="1" id="<?php echo $r['d_id']; ?>" class="<?php echo $r['price']; ?>" min="1" style="width: 70px;" />
                                </div>
                                <div class="price">
                                    <h4>Price</h4>
                                    <span class="price-inr">
                                    <i class="fa fa-inr"></i>
                                    <span class="amount"  id="<?php echo $r['d_id'].$r['d_id']; ?>"><?php echo $r['price']; ?></span>
                                </span>
                                </div>
                                <div class="delivery">
                                    <h4>Delivery</h4>
                                    <i class="fa fa-fighter-jet"></i>
                                    <span class="time">In 60 mins</span>
                                </div>
                            </div>
                            <input type="hidden" name="button1"></input>
                            <input type="submit" value="Total Price : <?php echo $r['price']; ?> Add to cart" id="<?php echo $r['d_id'].$r['d_id'].$r['d_id']; ?>" class="btn btn-primary" />
                            </form>
                            </div>
                            <?php                            
                        }
                    }
                    ?>
</div>
<script>
function send(qty,id){
    newid = id+id;
    newtotalid= id+id+id;
    price = document.getElementById(newid).textContent;
    console.log(qty,id,price);
    document.getElementById(newtotalid).value = "Total price : "+qty*price+" Add to cart";

}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>