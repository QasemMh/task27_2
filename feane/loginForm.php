<?php
session_start();

if (isset($_SESSION["username"])) {
  header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/favicon.png" type="">
  <title>Login/Sign Form</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <!-- css -->
  <link rel="stylesheet" href="css/loginCss.css" />
</head>

<body>
  
  <main class="main" id="main-container">
    <!-- box -->
    <div class="box">
      <!-- inner -->
      <div class="inner-box">
        <!-- forms -->
        <div class="forms-wrap">
          <!-- sign in -->
          <form action="" autocomplete="off" id="sign-in-form" class="sign-in-form">
            <div class="logo">
              <img src="images/favicon.png" alt="photo image LOGO" />
              <h4>Feane</h4>
            </div>
            <div class="heading">
              <h2>Welcome Back</h2>
              <h6>Not registered yet?</h6>
              <a href="#" class="toggle">Sign Up</a>
            </div>

            <div class="form">
              <div class="input-wrap">
                <input type="text" name="username" required class="input-feild" id="username" />
                <label for="username">Username</label>
              </div>
              <!--  -->
              <div class="input-wrap">
                <input type="password" name="password" required class="input-feild" minlength="3" id="password" />
                <label for="password">Password</label>
              </div>
              <button type="submit" class="sign-in-btn">Sign In</button>
              <p class="text">
                Forgotten your password or you login datails?
                <a href="#">Get help</a> signing in
              </p>
            </div>
          </form>
          <!--end  sign in -->

          <!-- sign up -->

          <form action="" autocomplete="off" id="sign-up-form" class="sign-up-form">
            <div class="logo">
              <img src="images/favicon.png" alt="photo image LOGO" />
              <h4>Feane</h4>
            </div>
            <div class="heading">
              <h2>Get Started</h2>
              <h6>Have an account?</h6>
              <a href="#" class="toggle" id="toggle-link">Sign in</a>
            </div>

            <div class="form">
              <div class="input-wrap">
                <input type="text" name="name" required class="input-feild" id="name" />
                <label for="name">Full Name</label>
              </div>
              <!--  -->
              <div class="input-wrap">
                <input type="text" name="username" required class="input-feild" id="username" />
                <label for="username">Username</label>
              </div>

              <!--  -->
              <div class="input-wrap">
                <input type="password" name="password" required class="input-feild" id="password" />
                <label for="password">Password</label>
              </div>

              <!--  -->
              <button type="submit" class="sign-in-btn">Sign Up</button>
              <p class="text">
                By signing up, I agree to the
                <a href="#">Terms of Services</a> and
                <a href="#">Privacy Policy</a>
              </p>
            </div>
          </form>

          <!-- end sign up -->
        </div>
        <!-- slider -->
        <div class="slider">
          <div class="image-wrapper">
            <img src="images/o1.jpg" class="image img-1 show" alt="image" />
            <img src="images/o2.jpg" class="image img-2" alt="image" />
            <img src="images/o1.jpg" class="image img-3" alt="image" />
          </div>

          <div class="text-slider">
            <div class="text-wrap">
              <div class="text-group">
                <h2>Lorem ipsum dolor sit amet.</h2>
                <h2>Lorem ipsum dolor sit amet.</h2>
                <h2>Lorem ipsum dolor sit amet.</h2>
              </div>
            </div>
            <div class="bullets">
              <span class="active" data-value="1"></span>
              <span data-value="2"></span>
              <span data-value="3"></span>
            </div>
          </div>
        </div>
        <!-- end inner -->
      </div>
      <!-- end box -->
    </div>
  </main>


  <?php require_once("footer.php") ?>