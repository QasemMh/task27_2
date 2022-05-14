$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    fetch("http://localhost:81/task27_2/api/booking?limit=1000")
      .then((response) => response.json())
      .then((data) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Capacity</th>
          <th>Date</th>
          <th>Action</th>
          </tr>`;
        let i = 1;
        for (const item of data) {
          tBody += `<tr> 
        <td>${i++}</td>
        <td>${item.name}</td>
        <td>${item.email}</td>
        <td>${item.phone}</td>
        <td>${item.capacity}</td>
        <td>${item.the_date}</td>
           <td> 
           <button class="btn btn-sm btn-info view_item" data-id=${
             item.id
           }>View booking</button>   
          
          <button class="btn btn-sm btn-primary update_item" data-id=${
            item.id
          }>Edit</button>


          <button class="btn btn-sm btn-danger delete_item" data-id=${
            item.id
          }>Delete</button>
          </td>
        </tr>`;
        }

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("User booking", "User booking Data");
      })
      .catch((err) => {
        console.error(err);
      });

    $("#create_item").hide();
  }

  //view booking
  $(document).on("click", ".view_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task27_2/api/booking/details/" + id;
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let view_item = `
        <dl class="row">
        <dt class="col-sm-3 text-right">Name</dt>
        <dd class="col-sm-9 text-left">${data.name}</dd>

        <dt class="col-sm-3 text-right">Email</dt>
        <dd class="col-sm-9 text-left">${data.email}</dd>

        <dt class="col-sm-3 text-right">Phone</dt>
        <dd class="col-sm-9 text-left"> ${data.phone}</dd>

        <dt class="col-sm-3 text-right">Capacity</dt>
        <dd class="col-sm-9 text-left"> ${data.capacity}</dd>

        <dt class="col-sm-3 text-right">Date</dt>
        <dd class="col-sm-9 text-left"> ${data.the_date}</dd>

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

  //edit booking
  // show html form when 'update category' button was clicked
  $(document).on("click", ".update_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task27_2/api/booking/details/" + id;
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let theDate = data.the_date.split("-");
        let update_item = `
          <form action="" method="POST" id="update_form">
          <input type="hidden" name="id" value="${data.id}">
          <div class="form-group">
          <label>Name</label>
          <input  type='text' value="${
            data.name
          }" name='name' class='form-control' required/>
          </div>
          <!--item-->
          
          <div class="form-group">
          <label>Email</label>
          <input  type='text' value="${
            data.email
          }" name='email' class='form-control' required/>
          </div>
          <!--item-->
     
          <div class="form-group">
          <label>Phone</label>
          <input  type='text' value="${
            data.phone
          }" name='phone' class='form-control' required/>
          </div>
          <!--item-->

          <div class="form-group">
          <label>capacity</label>
          <input  type='number' min="1" value="${
            data.capacity
          }" name='capacity' class='form-control' required/>
          </div>
          <!--item-->  
          
          <div class="form-group">
          <label>Date</label>
          <input  type='datetime-local'  value="${
            theDate[0] +
            "-" +
            theDate[1] +
            "-" +
            theDate[2].split(" ")[0] +
            "T" +
            theDate[2].split(" ")[1]
          }" name='the_date' class='form-control' required/>
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
        changePageTitle("Update Booking");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  // 'update form' submit handle will be here
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
    fetch("http://localhost:81/task27_2/api/booking/update/" + formData["id"], {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        //show all category
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });

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
        fetch("http://localhost:81/task27_2/api/booking/delete/" + id, {
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
