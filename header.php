<?php
include("connection/connect.php");
session_start(); //start temp session until logout/browser closed
$user_id= $_SESSION["user_id"];
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
                                        echo "<script type='text/javascript'>alert('no updated');</script>";
                                      }
                                      echo "<script type='text/javascript'>alert('<?php echo 'last' ?>');</script>";
                                    }
                                }  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="js/crypto-js.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" ';?> onclick="location.href='logout.php'" <?php echo ' ">
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
        <button type="button" class="btn btn-primary " id="verpass" data-bs-target="#custprofile2" data-bs-toggle="modal" data-bs-dismiss="modal" disabled>Next</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="custprofile2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
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
      <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $_SESSION['user_id'] ?>">
    </div>
  </fieldset>
  <div class="col-md-6" style="margin-top: 1%;">
  <label for="exampleFormControlInput1" class="form-label">User Name</label>
  <input type="text" value="<?php echo $row["username"];?>" class="form-control" id="usernameid" name="username" placeholder="User Name">
</div>
  <div class="row" style="margin-top: 1%;">
  <div class="col">
  <label for="exampleFormControlInput1" class="form-label">First Name</label>
    <input type="text" value="<?php echo $row["f_name"];?>" class="form-control" placeholder="First name" name="fname" aria-label="First name">
  </div>
  <div class="col">
  <label for="exampleFormControlInput1" class="form-label">Last Name</label>
    <input type="text" value="<?php echo $row["l_name"];?>" class="form-control" placeholder="Last name" name="lname" aria-label="Last name">
  </div>
</div>
<div class="col-md-6" style="margin-top: 1%;">
    <label for="inputEmail4" class="form-label">Phone no.</label>
    <input type="number" value="<?php echo $row["phone"];?>" class="form-control" id="inputEmail4" name="phno">
  </div>
<div class="col-md-6" style="margin-top: 1%;">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" value="<?php echo $row["email"];?>" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="col-md-6" style="margin-top: 1%;">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <div class="col-12" style="margin-top: 1%;">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control"  value="<?php echo $row["address"];?>" id="exampleFormControlTextarea1" name="address" rows="3"></textarea>
  </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="updateprofile" name="profilesubmit">Done</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  function checkpass(){
    var curpass = "<?php echo $password ?>";
    var newpass = $('#inputpassword').val();
    var newpass = CryptoJS.MD5(newpass).toString();
    if(newpass == curpass)
    {
      $("#verpass").prop('disabled', false);
    }
    else
    {
      alert("not matched");
    }
  }
  function updateprofile(){
    document.getElementById('profileform').submit();
  }
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
   
</body>
</html>