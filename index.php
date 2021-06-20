<?php
    include("connection/connect.php");  //include connection file
    // include("header.php");
    // include("userprofile.php");
    $output='';
    error_reporting(0);  // using to hide undefine undex errors
    session_start(); //start temp session until logout/browser closed
    $user_id = $_SESSION["user_id"];
    function rate($a){
        $stars = $a;
        $count = 1;
        $result = "";
        for($i = 1; $i <= 5; $i++){
            if($stars >= $count){
                $result .= "<span>&#x2605</span>";
            } else {
                $result .= "<span>&#x2606</span>";
            }
            $count++;
        }
        echo $result;
    }
    $getpass = "select * from users where u_id='$user_id'";
                                $getpassresult=mysqli_query($db, $getpass); //executing
                                $row=mysqli_fetch_array($getpassresult);
                                $password = $row['password'];   
                                if(isset($_POST['profilesubmit']))
                                {
                                    $username = $_POST['username'];
                                    $fname = $_POST['fname'];
                                    $lname = $_POST['lname'];
                                    $phno = $_POST['phno'];
                                    $email = $_POST['email'];
                                    $password = md5($_POST['password']);
                                    $address = $_POST['address'];
                                    $q = "select * from users where u_id='$user_id'";
                                    $getpassresult=mysqli_query($db, $q); //executing
                                    $row=mysqli_fetch_array($getpassresult);
                                    $curusername = $row['username'];
                                    $curfname = $row['f_name'];
                                    $curlname = $row['l_name'];
                                    $curemail = $row['email'];
                                    $curphno = $row['phone'];
                                    $currentpassword = $row['password'];
                                    $curaddress = $row['address'];
                                    if($username == '' && $fname == '' && $lname == '' && $phno == '' && $email == '' && $password == '' && $address == '')
                                    {
                                      echo "<script type='text/javascript'>alert('all are empty');</script>";
                                    }
                                    else
                                    {
                                      if($username == '')
                                      {
                                        $username = $curusername;
                                        
                                      }
                                      if($fname == '')
                                      {
                                        $fname = $curfname;
                                      }
                                      
                                      if($lname == '')
                                      {
                                        $lname = $curlname;
                                      }
                                      if($email == '')
                                      {
                                        $email = $curemail;
                                      }
                                      if($phno == '')
                                      {
                                        $phno = $curphno;
                                      }
                                      if($password == '')
                                      {
                                        $password = md5('$currentpassword');
                                      }
                                      if($address == '')
                                      {
                                        $address = $curaddress;
                                      }
                                      $proquery = "UPDATE users SET username='$username', f_name='$fname', l_name='$lname', email='$email', phone='$phno', password='$password', address='$address' WHERE u_id='$user_id'";
                                      $proval=mysqli_query($db, $proquery);
                                      if(mysqli_query($db, $proquery))
                                      {
                                        echo "<script type='text/javascript'>alert(<?php echo $phno; ?>);</script>";
}
else
{
echo "<script type='text/javascript'>
alert('no updated');
</script>";
}
echo "<script type='text/javascript'>
alert('<?php echo 'last' ?>');
</script>";
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script type="text/javascript" src="js/crypto-js.min.js"></script>
    <title>Food Point!</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/search.css">
    <title>Food Ordering System</title>
    <link rel="stylesheet" href="button.css">
    <!-- <link rel="stylesheet" href="css/login.css"> -->
    <link rel="stylesheet" href="css/footer.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <!-- <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/animation.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/indexcss.css">
    <link rel="stylesheet" href="css/style.min.css"> -->
    <style>
        .third {
            height: 50px;
            width: 200px;
            font-size: large;
            letter-spacing: 1px;
  border-color: #3498db;
  color: #fff;
  box-shadow: 0 0 40px 40px #3498db inset, 0 0 0 0 #3498db;
  -webkit-transition: all 150ms ease-in-out;
  transition: all 150ms ease-in-out;
}
.third:hover {
    color: #fff;
  box-shadow: 0 0 10px 0 #3498db inset, 0 0 10px 4px #3498db;
}

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                        <a class="nav-link" href="dishes.php?flag=true">Cart(<?php if(isset($_SESSION["cart_item"])){echo count($_SESSION["cart_item"]);}else{echo "0";}?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="your_orders.php">Your Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php" target="_blank">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                            if(empty($_SESSION['user_name'])) // if user is not login
                            {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
                                <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
                            } else {
                                //if user is login

                                echo  '<!-- Example split danger button -->
                                <div class="btn-group">
                                  <button type="button" class="btn btn-secondary">';
                                  echo $_SESSION['user_name'];
                                  
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
                    <form action="" method="post" id="profileform" class="needs-validation">
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

    <!-- end navigation -->
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="color: white;">
        <div id="container">
            <div class="companyname">
                <h1>Food Point</h1>
            </div>
            <div class="companyslogan">
                <h1>Get the best food & Enjoy</h1>
            </div>
            <div class="searchfood">
            <form class="form-inline" method="post" name="form1" id="idform" action="newcart.php">
                            <div class="form-group">
                                <input type="hidden" name="foodsearch" class="form-control form-control-lg" id="searchid" placeholder="I would like to eat...."> 
                                </div>
                            <input type="submit" name="button1"     class="btn third" value="View all food" ></input>
                        </form>
            </div>
        </div>
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                <img src="admin/Res_img/slider/1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="admin/Res_img/slider/2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="admin/Res_img/slider/3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end slider -->
    
    <!-- Popular block starts -->
    <section class="popular" style="margin-top: 30px;">
        <div class="container">
            <div class="title" style="margin-left: 40px;">
                <h2>Popular Dishes of the Month</h2>
                <p class="lead">The easiest way to your favourite food</p>
            </div>
            <div class="row gap-3">
                <?php 
                        // fetch records from database to display popular first 3 dishes from table
                        $query_res= mysqli_query($db,"select * from dishes"); 
                        while($r=mysqli_fetch_array($query_res))
                        {	
                            echo '<div class="col-sm-3" style="margin: auto;height: 500px;">
                            <div class="card" style="margin: auto; height: 90%;">
                              <img src="admin/Res_img/dishes/'.$r['img'].'" class="card-img-top" alt="..." style="height: 200px;">
                              <div class="card-body">
                                <h5 class="card-title">'.$r['food_name'].'</h5>
                                <div class="rate" style="font-size:xx-large;">';
                                rate($r['rate']);
                                echo '</div>
                                <p class="card-text">'.$r['slogan'].'</p>
                                <p class="card-text" style="font-weight:bold">₹'.$r['price'].'</p>
                                <a href="dishes.php?res_id='.$r['rs_id'].'&flag=false" class="btn btn-primary">View food</a>
                              </div>
                            </div>
                          </div>';
                        }
                    ?>
            </div>
        </div>
    </section>
    <!-- Popular block ends -->

    <!-- Featured restaurants starts -->
    <section class="featured-restaurants">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="title-block pull-left">
                        <h4>Featured restaurants</h4>
                    </div>
                </div>
            </div>
            <!-- restaurants listing starts -->
            <div class="row">
                <?php  
                            //fetching records from table and filter using html data-filter tag
                            $ress= mysqli_query($db,"select * from restaurant");  
                            while($rows=mysqli_fetch_array($ress))
                            {
                                // fetch records from res_category table according to catgory ID
                                $query= mysqli_query($db,"select * from res_category where c_id='".$rows['c_id']."' ");
                                $rowss=mysqli_fetch_array($query);						
                                echo '<div class="col-sm-6"><div class="card mb-6" style="max-width: 670px; margin-top: 20px;">
                                <div class="row g-0">
                                  <div class="col-md-4">
                                    <img src="admin/Res_img/'.$rows['image'].'" alt="..." style="height: 200px; width: 250px;">
                                  </div>
                                  <div class="col-md-5" style="width: 200px; margin-left: 10%">
                                    <div class="card-body" style="margin-left: 10px;">
                                      <a href="dishes.php?res_id='.$rows['rs_id'].'" style="text-decoration: none;"><h5 class="card-title">'.$rows['title'].'</h5></a>
                                      <p class="card-text">'.$rows['address'].'</p>
                                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>
                                  </div>
                                </div>
                              </div></div>';
                            }
						?>
            </div>
        </div>
    </section>
    <!-- restaurants listing ends -->
    <!-- Footer start -->
    <hr class="dropdown-divider">
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
    <!-- Footer end -->
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
    function checkpass() {
        var curpass = '<?php echo $password ?>';
        var newpass = $('#inputpassword').val();
        var newpass = CryptoJS.MD5(newpass).toString();
        console.log(newpass);
        console.log(curpass);
        if (newpass == curpass) {
            $("#verpass").prop('disabled', false);
        } else {
            alert("not matched");
        }
    }

    function updateprofile() {
        document.getElementById('profileform').submit();
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
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/indexjs.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script> -->

</body>

</html>