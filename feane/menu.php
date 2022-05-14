 <?php require_once("header.php");
  ?>

 <!-- end header section -->
 </div>

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
       
     </div>
 </section>



 <?php require_once("footer.php") ?>