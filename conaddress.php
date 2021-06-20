<?php
include("connection/connect.php");  //include connection file
session_start(); //start temp session until logout/browser closed
    if(isset($_SESSION['user_name']))
    {
        $name2 = $_SESSION['user_name'];
    }
    elseif(isset($_SESSION["user_name"]))
    {
        $name2= $_SESSION["user_name"];
        $user_id= $_SESSION["user_id"];        
    }
    $val = "select * from users where username='$name2'";
    $getval = mysqli_query($db, $val); //executing
    $getdetail=mysqli_fetch_array($getval);     
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cofirm Address</title>
    <!-- <link rel="stylesheet" href="css/search.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/groupbtn.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body style="margin: auto;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: rgba(77,68,66,0.5);">
        <div class="container-fluid">
            <a class="navbar-brand" href="index32.php" style="margin-left: 20px;">
                <div class="card" style="width: 50px;">
                    <img src="images/fast-food2.png" class="card-img-top" alt="...">
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
                            if(empty($_SESSION["user_name"])) // if user is not login
                            {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
                                <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
                            } else {
                                //if user is login

                                echo  '<!-- Example split danger button -->
                                <div class="btn-group">
                                  <button type="button" class="btn btn-secondary">';
                                  echo $_SESSION["user_name"];
                                  
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
    <div class="page-wrapper" style="margin: auto;">
        <!-- top Links -->
        <div class="groupbtn">
            <div class="btn-group">
                <a href="#">
                    <button type="button" class="btn btn-outline-primary disabled" style="border-radius: 50px 0 0 0;">
                        Pick Your favorite food
                    </button>
                </a>
                <a href="#">
                    <button type="button" class="btn btn-outline-primary active" style="border-radius: 0 0 0 0;">
                        Confirm Details
                    </button>
                </a>
                <a href="#">
                    <button type="button" class="btn btn-outline-primary disabled" style="border-radius: 0 0 50px 0;">
                        Order and Pay online
                    </button>
                </a>
            </div>

        </div>
        <!-- end:Top links -->
    </div>


    <form class="row g-3 w-75 border rounded border-2" style="margin: auto" id="detailform">
        <div class="col-md-6" style="margin-top: 1%;">
            <label for="exampleFormControlInput1" class="form-label">User Name</label>
            <input type="text" class="form-control" id="usernameid" name="username"
                value="<?php echo $getdetail["username"]; ?>">
        </div>
        <div class="row" style="margin-top: 1%;">
            <div class="col">
                <label for="exampleFormControlInput1" class="form-label">First Name</label>
                <input type="text" class="form-control" value="<?php echo $getdetail["f_name"]; ?>" name="fname"
                    aria-label="First name">
            </div>
            <div class="col">
                <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                <input type="text" class="form-control" value="<?php echo $getdetail["l_name"]; ?>" name="lname"
                    aria-label="Last name">
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 1%;">
            <label for="inputEmail4" class="form-label">Phone no.</label>
            <input type="number" class="form-control" id="inputEmail4" name="phno"
                value="<?php echo $getdetail["phone"]; ?>">
        </div>
        <div class="col-md-6" style="margin-top: 1%;">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" value="<?php echo $getdetail["email"]; ?>" name="email"
                id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" id="inputAddress" value="<?php echo $getdetail["address"]; ?>">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">City</label>
            <input type="text" class="form-control" value="Surat" id="inputCity">
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">State</label>
            <select id="inputState" class="form-select">
                <option selected>Gujarat</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="inputZip" class="form-label">Zip</label>
            <input type="text" class="form-control" id="inputZip" value="394101">
        </div>

        <div class="col-12">
            <button type="button" class="btn btn-outline-primary w-100" onclick="detailform()">Go for Payment</button>
            <div style="height: 10px;"></div>
        </div>

    </form>
    <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>" style="visibility: hidden;"
        class="btn theme-btn btn-lg" id="sendform">Go for payment</a>
    </div>
    <div class="footer-basic" id="footer">
        <footer class="text-center">
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a>
                                <a href="#"><i class="icon ion-social-snapchat"></i></a>
                                <a href="#"><i class="icon ion-social-twitter"></i></a>
                                <a href="#"><i class="icon ion-social-facebook"></i></a>
            </div>
            <h6>By continuing past this page, you agree to our Terms of Service, Cookie Policy, Privacy Policy and Content Policies. All trademarks are properties of their respective owners. 2008-2021 © Food Point™ Ltd. All rights reserved.</h6>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">About Us</a></li>
                <li class="list-inline-item"><a href="#">Terms & Condition</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright fw-bold">Food Point © 2021</p>
        </footer>
    </div>
    <script>
    function detailform() {
        document.getElementById('sendform').click();
    }
    </script>
</body>

</html>