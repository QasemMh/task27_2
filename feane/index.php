<?php
$page_title = "booking";
require_once("header.php");

?>






<!-- end header section -->
<!-- slider section -->
<section class="slider_section ">
  <div id="customCarousel1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" id="slider-data">
    </div>
    <div class="container">
      <ol class="carousel-indicators">
        <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
        <li data-target="#customCarousel1" data-slide-to="1"></li>
        <li data-target="#customCarousel1" data-slide-to="2"></li>
      </ol>
    </div>
  </div>

</section>
<!-- end slider section -->
</div>

<!-- offer section -->

<section class="offer_section layout_padding-bottom">
  <div class="offer_container">
    <div class="container ">
      <div class="row" id="special-data">


      </div>
    </div>
  </div>
</section>

<!-- end offer section -->

<!-- food section -->

<section class="food_section layout_padding-bottom" id="food_section-id">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Our Menu
      </h2>
    </div>

    <ul class="filters_menu">
      <li class="active" data-filter="*">All</li>
      <li data-filter=".burger">Burger</li>
      <li data-filter=".pizza">Pizza</li>
      <li data-filter=".pasta">Pasta</li>
      <li data-filter=".fries">Fries</li>
    </ul>

    <div class="filters-content">
      <div class="row grid" id="menu-data">

      </div>
      <div class="btn-box">
        <a href="menu.php">
          View More
        </a>
      </div>
    </div>
</section>

<!-- end food section -->

<!-- about section -->

<section class="about_section layout_padding">
  <div class="container  ">

    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="images/about-img.png" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              We Are Feane
            </h2>
          </div>
          <p>
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            in some form, by injected humour, or randomised words which don't look even slightly believable. If you
            are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
            the middle of text. All
          </p>
          <a href="">
            Read More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->

<!-- book section -->
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Book A Table
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form_container">
          <form action="" id="booking-form">
            <div>
              <input type="text" name="name" class="form-control" required placeholder="Your Name" />
            </div>
            <div>
              <input type="text" name="phone" class="form-control" required placeholder="Phone Number" />
            </div>
            <div>
              <input type="email" name="email" class="form-control" required placeholder="Your Email" />
            </div>
            <div>
              <select class="form-control nice-select wide" required name="capacity">
                <option value="" disabled selected>
                  How many persons?
                </option>
                <option value="2">
                  2
                </option>
                <option value="3">
                  3
                </option>
                <option value="4">
                  4
                </option>
                <option value="5">
                  5
                </option>
              </select>
            </div>
            <div>
              <input type="datetime-local" required name="the_date" class="form-control">
            </div>
            <div class="btn_box">

              <?php

              if (isset($_SESSION["username"])) {
                echo ' <button type="submit" 
                 id="submit-btn0"
                 data-username="' . $_SESSION["username"]  . '">Book Now</button>';
              } else {
                echo ' <button type="button" id="auth-btn">
                Book NOW
              </button>';
              }



              ?>

            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="map_container">

        </div>
      </div>
    </div>
  </div>
</section>
<!-- end book section -->

<!-- client section -->

<section class="client_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center psudo_white_primary mb_45">
      <h2>
        What Says Our Customers
      </h2>
    </div>
    <div class="carousel-wrap row">
      <div class="owl-carousel client_owl-carousel" id="feedback-data">




      </div>
    </div>
  </div>
</section>

<!-- end client section -->

<?php require_once("footer.php") ?>