 <?php require_once("header.php");
  ?>

 </div>

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



 <?php require_once("footer.php") ?>