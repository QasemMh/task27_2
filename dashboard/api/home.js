$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    fetch("http://localhost:81/task27_2/api/home")
      .then((response) => response.json())
      .then((item) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
          <th>id</th>
          <th>tap_title</th>
          <th>logo_name</th>
          <th>facebook_url</th>
          <th>insta_url</th>
          <th>twitter_url</th>
           <th>Action</th>
          </tr>`;
        let i = 1;
        tBody += `<tr> 
        <td>${i++}</td>
        <td>${item.tap_title}</td>
        <td>${item.logo_name}</td>
        <td> <a href="${item.facebook_url}" target="_blank">Link</a> </td>
        <td><a href="${item.insta_url}" target="_blank">Link</a></td>
        <td><a href="${item.twitter_url}" target="_blank">Link</a></td>

         <td>
         <button class="btn btn-sm btn-primary update_item" data-id=${
           item.id
         }>Edit</button>

        <button class="btn btn-sm btn-info view_item" data-id=${
          item.id
        }>View</button>


        <button class="btn btn-sm btn-danger delete_item" data-id=${
          item.id
        }>Delete</button></td>
        </tr>`;

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("home", "home Data");
      })
      .catch((err) => {
        console.error(err);
      });
  }

  //view
  $(document).on("click", ".view_item", function () {
    let uri = "http://localhost:81/task27_2/api/home";
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let view_item = `
        <dl class="row">
        <dt class="col-sm-3 text-right">tap_title</dt>
        <dd class="col-sm-9 text-left">${data.tap_title}</dd>

        <dt class="col-sm-3 text-right">logo_name</dt>
        <dd class="col-sm-9 text-left">${data.logo_name}</dd>

        <dt class="col-sm-3 text-right">facebook_url</dt>
        <dd class="col-sm-9 text-left"> ${data.facebook_url}</dd>

        <dt class="col-sm-3 text-right">insta_url</dt>
        <dd class="col-sm-9 text-left"> ${data.insta_url}</dd>

        <dt class="col-sm-3 text-right">twitter_url</dt>
        <dd class="col-sm-9 text-left"> ${data.twitter_url}</dd>

        <dt class="col-sm-3 text-right">phone</dt>
        <dd class="col-sm-9 text-left"> ${data.phone}</dd>

        <dt class="col-sm-3 text-right">email</dt>
        <dd class="col-sm-9 text-left"> ${data.email}</dd>

        <dt class="col-sm-3 text-right">location</dt>
        <dd class="col-sm-9 text-left"> ${data.location}</dd>

        <dt class="col-sm-3 text-right">open_hour</dt>
        <dd class="col-sm-9 text-left"> ${data.open_hour}</dd>

        <dt class="col-sm-3 text-right">about</dt>
        <dd class="col-sm-9 text-left"> ${data.about}</dd>

        

        </dl>  
        
          <!--item-->
          <div class="form-group w-50">
           <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
          </div>
        `;

        $("#app .card-body").html(view_item);
        changePageTitle("View booking");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  //Create
  // show html form when 'create item' button was clicked
  $(document).on("click", "#create_item", function () {
    /*html*/
    let create_form = `
            <form action="" method="POST" id="create_form">
            <div class="form-group  w-75">
            <label>Logo Name</label>
            <input  type='text' name='logo' class='form-control' required/>
            </div>
            
            <div class="form-group w-75">
            <label>Tap Name</label>
            <input  type='text' name='tap' class='form-control' required/>
            </div>

            <div class="form-group">
            <label class="sr-only" for="facebook">Facebook</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fab fa-facebook"></i></div>
                </div>
                <input type="text" name="facebook" class="form-control" id="facebook" required placeholder="Facebook uri">
            </div>
            </div>
            <!--item-->
            <div class="form-group">
            <label class="sr-only" for="insta">instagram</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                </div>
                <input type="text" name="insta" class="form-control" id="insta" required placeholder="insta uri">
            </div>
            </div>
            <!--item-->
            <div class="form-group">
            <label class="sr-only" for="facebook">Twitter</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fab fa-twitter"></i></div>
                </div>
                <input type="text" name="twitter" class="form-control" id="twitter" required placeholder="twitter uri">
            </div>
            </div>

            <!--item-->
            <div class="form-group w-75">
            <label>phone</label>
            <input  type='text' name='phone' class='form-control' required/>
            </div> 
            
            <!--item-->
            <div class="form-group w-75">
            <label>email</label>
            <input  type='email' name='email' class='form-control' required/>
            </div>

            <!--item-->
            <div class="form-group w-75">
            <label>location</label>
            <input  type='text' name='location' class='form-control' required/>
            </div> 
            
            <!--item-->
            <div class="form-group w-75">
            <label>open_hour</label>
            <input  type='text' name='open_hour' class='form-control' required/>
            </div>

            <!--item-->
            <div class="form-group w-75">
            <label>about</label>
            <input  type='text' name='about' class='form-control' required/>
            </div>
            
            <!--item-->
            <div class="form-group w-50">
            <button  type='submit' class="btn btn-primary" >Submit</button>
            <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
            </div>
            <!--item-->
            
            </form>
            `;

    $("#app .card-body").html(create_form);
    changePageTitle("Create home");
    $("#back-btn").on("click", function () {
      getAll();
    });
  });

  // will run if create  form was submitted
  $(document).on("submit", "#create_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("create_form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch("http://localhost:81/task27_2/api/home/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        //show all home
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end index

  //update:
  // show html form when 'update home' button was clicked
  $(document).on("click", ".update_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task27_2/api/home";
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let update_item = `
        <form action="" method="POST" id="create_form">
        <input type="hidden" name="id" value="${data.id}">
        <div class="form-group  w-75">
        <label>Logo Name</label>
        <input  type='text' value="${data.logo_name}" name='logo' class='form-control' required/>
        </div>
        
        <div class="form-group w-75">
        <label>Tap Name</label>
        <input  type='text' name='tap' value="${data.tap_title}" class='form-control' required/>
        </div>

        <div class="form-group">
        <label class="sr-only" for="facebook">Facebook</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fab fa-facebook"></i></div>
            </div>
            <input type="text" value="${data.facebook_url}" name="facebook" class="form-control" id="facebook" required placeholder="Facebook uri">
        </div>
        </div>
        <!--item-->
        <div class="form-group">
        <label class="sr-only" for="insta">instagram</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fab fa-instagram"></i></div>
            </div>
            <input type="text" name="insta" value="${data.insta_url}" class="form-control" id="insta" required placeholder="insta uri">
        </div>
        </div>
        <!--item-->
        <div class="form-group">
        <label class="sr-only" for="facebook">Twitter</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fab fa-twitter"></i></div>
            </div>
            <input type="text" name="twitter"  value="${data.twitter_url}" class="form-control" id="twitter" required placeholder="twitter uri">
        </div>
        </div>
        <!--item-->


         <!--item-->
         <div class="form-group w-75">
         <label>phone</label>
         <input  type='text' name='phone' value="${data.phone}"  class='form-control' required/>
         </div> 
         
         <!--item-->
         <div class="form-group w-75">
         <label>email</label>
         <input  type='email' name='email' value="${data.email}" class='form-control' required/>
         </div>

         <!--item-->
         <div class="form-group w-75">
         <label>location</label>
         <input  type='text' name='location' value="${data.location}" class='form-control' required/>
         </div> 
         
         <!--item-->
         <div class="form-group w-75">
         <label>open_hour</label>
         <input  type='text' name='open_hour' value="${data.open_hour}" class='form-control' required/>
         </div>

         <!--item-->
         <div class="form-group w-75">
         <label>about</label>
         <input  type='text' name='about' value="${data.about}" class='form-control' required/>
         </div>
         

        
        <!--item-->
        <div class="form-group w-50">
        <button  type='submit' class="btn btn-primary" >Save</button>
        <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
        </div>
        <!--item-->
        
        </form>
              `;

        $("#app .card-body").html(update_item);
        changePageTitle("Update home");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  // 'update home form' submit handle will be here
  // will run if create home form was submitted
  $(document).on("submit", "#update_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("update_form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch("http://localhost:81/task27_2/api/home/update/" + formData["id"], {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        //show all home
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end update

  //delete
  // will run if the delete button was clicked
  $(document).on("click", ".delete_item", function () {
    let id = $(this).attr("data-id");
    // alert
    Swal.fire({
      title: "Do you want to Delete this?",
      showCancelButton: true,
      confirmButtonText: "Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("http://localhost:81/task27_2/api/home/delete/" + id, {
          method: "POST",
        })
          .then((respon) => {
            $(this).parents("tr").fadeOut();
            Swal.fire("Deleted!", "", "success");
          })
          .catch((error) => {
            Swal.fire({
              icon: "error",
              title: "Oops... " + error,
              text: "Something went wrong!",
            });
          });
      }
    });
  });
});
