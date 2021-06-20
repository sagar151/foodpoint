<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact with Food Point</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Food Point</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="d-flex" style="margin-right: 0px;">
      <ul style="list-style-type: none;display:flex;">
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
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" ';?>
                                onclick="location.href='logout.php'" <?php echo ' ">
                                    Log out
                                  </button>
                                  </div>
                                  </ul>
                                </div>';
                                      
                            }
                            ?>
                            </ul>
      </form>
    </div>
  </div>
</nav>
<div class="space" style="margin-top: 50px;"></div>
<div class="container">
  <div class="row">
    <div class="col-8">
        <form class="row g-3">
            <div class="col-12">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>How can we help you?</option>
                        <option value="1">I need help with my FoodPoint online order.</option>
                        <option value="2">I found incorrect/outdated information on a page.</option>
                        <option value="3">There is a photo/review that is bothering me and I would like to report it.</option>
                        <option value="4">The website/app are not working the way they should.</option>
                        <option value="5">I would like to give feedback/suggestions.</option>
                        <option value="6">I need some help with my blog.</option>
                    </select>
            </div>
            <div class="row mb-3" style="margin-top: 15px;">
                <label for="fullname" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="fullname">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3">
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone" class="col-sm-2 col-form-label">Phone No.</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="phone">
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type Text</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-danger">Submit feedback</button>
            </div>
        </form>
    </div>
    <div class="col-4">
        <div class="row">
            <div class="card border-success mb-3" style="max-width: 18rem;">
            <div class="card-header"><h5 class="card-title">Report a Safety Emergency</h5></div>
            <div class="card-body text-success">
                
                <p class="card-text">We are committed to the safety of everyone using Food Point.</p>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="card border-success mb-3" style="max-width: 18rem;">
            <div class="card-header"><h5 class="card-title">Issue with your live order?</h5></div>
            <div class="card-body text-success">
                
                <p class="card-text">Click on the 'Support' or 'Online ordering help' section in your app to connect to our customer support team.</p>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="card border-success mb-3" style="max-width: 18rem;">
            <div class="card-header"><h5 class="card-title">Issue with Food Point?</h5></div>
            <div class="card-body text-success">
                
                <p class="card-text">Click on the 'Help' section in your app to connect to our support team.</p>
            </div>
            </div>
        </div>
    </div>
  </div>
</div>



   
</body>
</html>