<?php
    include("connection/connect.php"); // connection to db
    error_reporting(0);
    session_start();
    include_once 'product-action.php'; //including controller
    // include_once 'header.php';
    $user_id = $_SESSION["user_id"];

    $getpass = "select * from users where u_id='$user_id'";
                                $getpassresult=mysqli_query($db, $getpass); //executing
                                $row=mysqli_fetch_array($getpassresult);
                                $password = $row['password'];  
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="js/crypto-js.min.js"></script>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Online Food Ordering System</title>
    <link rel="stylesheet" href="css/groupbtn.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/backbutton.css">
    <link rel="stylesheet" href="css/tooltip.css">
    <style>

.footer-basic {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   text-align: center;
}
    </style>
</head>

<body>
    <script>
    $(function() {
        //$('#finbtn').click();
        flag = '<?php echo $_GET['flag']; ?>';
        if (flag == 'true') {

        } else {
            document.getElementById('secondcanvasbtn').click();
        }
    });
    </script>
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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="restaurants.php">Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="dishes.php?flag=true">Cart(<?php if(isset($_SESSION["cart_item"])){echo count($_SESSION["cart_item"]);}else{echo "0";}?>)</a>
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
    <!-- /.navbar -->
    </header>
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="groupbtn">
            <div class="btn-group">
                <a href="#">
                    <button type="button" class="btn btn-outline-primary active" style="border-radius: 50px 0 0 0;">
                        Pick Your favorite food
                    </button>
                </a>
                <a href="#">
                    <button type="button" class="btn btn-outline-primary disabled" style="border-radius: 0 0 0 0;">
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




    <table class="table w-75 border rounded border-4" style="margin: auto;" id="ordertable">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Food Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $item_total = 0;
            $count = 1;
            foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
            {
                $getfoodimg = "select * from dishes where d_id='".$item["d_id"]."'";
                $getfoodres =mysqli_query($db, $getfoodimg); //executing
                $imgrow=mysqli_fetch_array($getfoodres);
                ?>
            <tr>
                <th scope="row"><?php echo $count;$count++; ?></th>
                <td class="toolpoint" ><?php echo $item["food_name"]; ?>
                    <div class="toolimg">
                        <?php echo '<img src="admin/Res_img/dishes/'.$imgrow['img'].'" alt="Food logo" style="height: 200px;width:100%">'; ?>
                    </div>
                </td>
                <td><?php echo $item["price"]; ?></td>
                <td style="margin: auto;"><?php echo $item["quantity"]; ?>
                    <div class="btn-group" role="group" aria-label="Basic outlined example"
                        style="float: right;margin-right: 25%;">
                        <form method="post"
                            action='dishes.php?res_id=<?php echo $item['res_id'];?>&action=add&id=<?php echo $item['d_id']; ?>&flag=true'>
                            <span class="price pull-left"
                                style="visibility: hidden">₹<?php echo $item['price']; ?></span>
                            <input class="b-r-0.5" type="hidden" name="quantity" value="1" size="2" />
                            <input type="submit" class="btn btn-outline-success" value="+"
                                style="margin-left: -25%;" /><i class="fas fa-plus"></i>
                        </form>
                        <a
                            href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>&flag=true"><button
                                type="button" class="btn btn-outline-danger">-</button>
                    </div>
                </td>
                <td><?php echo $item["price"]*$item["quantity"];?></td>
            </tr>
            <?php
                $item_total += ($item["price"]*$item["quantity"]); // calculating current price into cart
            }
        ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <th><span style="margin-left: 50%;">Gross Total</span></th>
                <th><?php echo "₹".$item_total; ?></th>
            </tr>
        </tbody>
    </table>
    <!-- restaurant part -->
    <div class="offcanvas offcanvas-start" tabindex="-1" style="width: 50%;" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Restaurants</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php 
        // fetch records from database to display popular first 3 dishes from table
        echo '<script>"alert("offcanvasbodary")"</script>';
        $query_res= mysqli_query($db,"select * from restaurant"); 
        while($r=mysqli_fetch_array($query_res))
        {	
            echo '<div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-4" style="width:40%;">
                <img src="admin/Res_img/'.$r['image'].'" alt="Restaurant Image" style="height: 100%;width: 100%;">
              </div>
              <div class="col-md-8"  style="width:60%;">
                <div class="card-body">
                  <h5 class="card-title">'.$r['title'].'</h5>
                  <p class="card-text">'.$r['address'].'</p>
                  <p class="card-text">'.$r['phone'].'</p>
                  <p class="card-text">'.$r['o_days'].'</p>
                  <a href="dishes.php?res_id='.$r['rs_id'].'" id="'.$r['rs_id'].'"><button class="btn btn-primary" type="button">View Food</button></a>
                        <button class="btn btn-primary" style="visibility: hidden;" type="button" id="secondcanvasbtn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></button>
                </div>
              </div>
            </div>
          </div>';
                      
        }
        ?>

        </div>
    </div>
    <script>
    function right(a) {
        rsi_id = a;
        temp = "TEMP";
        mybtn = document.getElementById('rsbtn2');
        mybtn.value = a;

        document.getElementById("secondfrmbtn").click();
        $('#a').click();
    }
    </script>
    <button class="btn btn-primary" type="button" style="visibility: hidden" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>

    <div class="offcanvas offcanvas-end" style="width: 70%;" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header" style="text-align: center;">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.9481 14.8285L10.5339 16.2427L6.29126 12L10.5339 7.7574L11.9481 9.17161L10.1197 11H17.6568V13H10.1197L11.9481 14.8285Z"
                        fill="currentColor" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M23 19C23 21.2091 21.2091 23 19 23H5C2.79086 23 1 21.2091 1 19V5C1 2.79086 2.79086 1 5 1H19C21.2091 1 23 2.79086 23 5V19ZM19 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H19C20.1046 3 21 3.89543 21 5V19C21 20.1046 20.1046 21 19 21Z"
                        fill="currentColor" />
                </svg>
            </button>
            <h5 id="offcanvasRightLabel" style="margin-left: 40%;font-size: 30px;font-family: 'Orbitron', sans-serif;">
                Food</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <div id="temp"></div>
            <div class="row row-cols-1 row-cols-md-3 g-4">  
                <?php 
           
    $rest_id = $_GET['res_id'];
    $flag = $_GET['res_id'];
$query_res= mysqli_query($db,"select * from dishes where rs_id='$rest_id'"); 
        while($rfood=mysqli_fetch_array($query_res))
        {
            ?>
                <div class="col">
                    <div class="card h-150">
                        <?php echo '<img src="admin/Res_img/dishes/'.$rfood['img'].'" alt="Food logo" style="height: 200px;width:100%">'; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $rfood['food_name']; ?></h5>
                            <form method="post"
                                action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $rfood['d_id']; ?>'>
                                <p style="height: 40px;"> <?php echo $rfood['slogan']; ?></p><span style="font-size: 1.4em;display:table;margin:0 auto;"><?php rate($rfood['rate']); ?></span>
                                <span class="price pull-left">₹<?php echo $rfood['price']; ?></span>
                                <div class="qty" style="float: right; background-color: inherit;">
                                    Qty.
                                    <input class="b-r-0.5" type="number" name="quantity" value="1" size="1"
                                        style="width: 75px;" id="<?php echo $rfood['d_id'].$rfood['d_id'].$rfood['d_id']; ?>"/>
                                </div>
                                <hr class="dropdown-divider">
                                <input type="button" onclick="addqty(this.id);" id="<?php echo $rfood['d_id']; ?>" class="btn btn-outline-primary" value="Add to cart" />
                            </form>
                        </div>
                    </div>
                </div>
                <?php
        }
        ?>
            </div>
        </div>
    </div>
    <div class="w-75" style="width: 50%; margin: auto;">
        <a class="btn btn-outline-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
            aria-controls="offcanvasExample">
            Go to Restaurants
        </a>
        <a href="conaddress.php?res_id=<?php echo $_GET['res_id'];?>"><button class="btn btn-outline-primary"
                style="margin-right: 0; float: right" type="button">Go to confirm address</button></a>
    </div><br><br><br><br><br><br>
    <div class="footer-basic" id="footer" style="position: relative;">
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
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    })
    </script>
    <script>
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
    function addqty(id){
    newid = id+id+id;

    qty = document.getElementById(newid).value;
    console.log(id,qty);
    $.ajax({
                type:'POST',
                url:'newproaction.php',
                data: {id:id,qty:qty},
                success:function(html){
                    $('#temp').html(html);
                    $("#cartlink").load(location.href+" #cartlink >*","");
                    $("#ordertable").load(location.href+" #ordertable >*","");
                }
            }); 
};
    function updateprofile() {
        document.getElementById('profileform').submit();
    }
    </script>
    <script>
        $( function () {

    var height_diff = $( window ).height() - $( 'body' ).height();
    if ( height_diff > 0 ) {
        $( '#footer' ).css( 'margin-top', height_diff );
    }

});
    </script>

    <script>
    function primary() {
        $("#content").prop('disabled', true);
    }

    function secondary() {
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

</body>

</html>