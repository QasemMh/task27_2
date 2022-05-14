<?php

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <!-- css -->
    <link rel="stylesheet" href="css/shopping.css" />
</head>

<body>
    <div class="shopping-container">
        <div class="shopping-cart" id="shopping-cart"></div>
        <div class="summary">
            <h3 class="summary-title">Summary</h3>
            <div class="summary-prices">
                <span class="summary-subtitle">Total Item</span>
                <span class="summary-price" id="total-items">0</span>
            </div>
            <div class="summary-prices">
                <span class="summary-subtitle">Total Price</span>
                <span class="summary-price">$ <span id="total-price">000.00</span></span>
            </div>
            <button class="summary-button" id="submit-btn">Order Now</button>
        </div>
    </div>
    <!--  -->
</body>

</html>


<?php require_once("footer.php") ?>