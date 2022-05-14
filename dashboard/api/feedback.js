$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    fetch("http://localhost:81/task27_2/api/feedback?limit=1000")
      .then((response) => response.json())
      .then((data) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
            <th>id</th>
            <th>name</th>
            <th>content</th>
            <th>Action</th>
            </tr>`;
        let i = 1;
        for (const item of data) {
          tBody += `<tr> 
          <td>${i++}</td>
          <td>${item.name}</td>
          <td>${item.content}</td>
            <td><button class="btn btn-sm btn-info update_item" data-id=${
              item.id
            }>Edit</button>
           <button class="btn btn-sm btn-danger delete_item" data-id=${
             item.id
           }>Delete</button>
          <button class="btn btn-sm btn-secondary view_item" data-id=${
            item.id
          }>View</button>
          </td>
          </tr>`;
        }

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("feedback", "feedback Data");
      })
      .catch((err) => {
        console.error(err);
      });
  }

  //view
  $(document).on("click", ".view_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task27_2/api/feedback/details/" + id;
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let view_item = `
            <div class="row">
            <div class="col-md-8 overflow-hidden m-auto">
            <img src="http://localhost:81/task27_2/image/${data.path}" class="img-fluid" alt="feedback image">  
            </div>
    
           <div class="col-md-12 mt-4">
        
            <dl class="row">
    
            <dt class="col-sm-3 text-left">name</dt>
            <dd class="col-sm-9 text-left">${data.name}</dd>
  
            <dt class="col-sm-3 text-left">content</dt>
            <dd class="col-sm-9 text-left">${data.content}</dd>
    
            </dl> 
            </div>
            </div> 
            
              <!--item-->
              <div class="form-group w-50">
               <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
              </div>
            `;

        $("#app .card-body").html(view_item);
        changePageTitle("View Message");
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
                <form action="" method="POST" id="create_form" enctype="multipart/form-data">
                <div class="form-group">
                <label>name</label>
                <input  type='text' name='name' class='form-control' required/>
                </div>
                <!--item-->    <div class="form-group">
                <label>content</label>
                <input  type='text' min="1" name='content' class='form-control' required/>
                </div>
                <!--item-->
                <div class="input-group mb-3 w-50">
                <div class="custom-file">
                  <input type="file" name="path" class="custom-file-input" id="inputGroupFile01" required accept="image/*">
                  <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
                </div>
              </div>
                <!--item-->
                <div class="form-group w-50">
                <button  type='submit' class="btn btn-primary" >Submit</button>
                <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
                </div>
                <!--item-->
                </form>`;

    $("#app .card-body").html(create_form);
    changePageTitle("Create feedback");
    $("#back-btn").on("click", function () {
      getAll();
    });
  });

  // will run if create  form was submitted
  $(document).on("submit", "#create_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("create_form");
    let formData = new FormData();

    form.querySelectorAll("input[type='text']").forEach((element) => {
      formData.append(element.name, element.value);
    });

    form.querySelectorAll("input[type='file']").forEach((element) => {
      formData.append(element.name, element.files[0]);
    });

    // Send data to backend
    fetch("http://localhost:81/task27_2/api/feedback/create", {
      method: "POST",
      body: formData,
    }).then((res) => {
      if (res.ok) {
        //show all feedback
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end index

  //update:
  // show html form when 'Update feedback ' button was clicked
  $(document).on("click", ".update_item", function () {
    let id = $(this).attr("data-id");
    let feedbackUri = "http://localhost:81/task27_2/api/feedback/details/" + id;

    fetch(feedbackUri)
      .then((res) => res.json())
      .then((data) => {
        //generate create form for feedback:
        /*html*/
        let update_form = `
        <form action="" method="POST" id="update_form" enctype="multipart/form-data">
        <input type="hidden" value="${data.id}" name="id">
    
        <div class="form-group">
        <label>name</label>
        <input  type='text' value="${data.name}"  name='name' class='form-control' required/>
        </div>
        <!--item-->  <div class="form-group">
        <label>content</label>
        <input  type='text' value="${data.content}"  name='content' class='form-control' required/>
        </div>
        <!--item-->
        <div class="input-group mb-3 w-50">
        <input type="hidden" value="${data.path}" name="path2">
        <div class="custom-file">
          <input type="file" name="path" class="custom-file-input" id="inputGroupFile01" accept="image/*">
          <label class="custom-file-label" for="inputGroupFile01">Update Image?</label>
        </div>
      </div>
        <!--item-->
        <div class="form-group w-50">
        <button  type='submit' class="btn btn-primary" >Save</button>
        <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
        </div>
        <!--item-->
        </form>`;

        $("#app .card-body").html(update_form);
        changePageTitle("Update feedback");

        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  //end update form
  // 'update feedback form' submit handle will be here
  // will run if create user form was submitted
  $(document).on("submit", "#update_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("update_form");
    let formData = new FormData();

    form.querySelectorAll("input[type='text']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    form.querySelectorAll("input[type='hidden']").forEach((element) => {
      formData.append(element.name, element.value);
    });

    form.querySelectorAll("input[type='file']").forEach((element) => {
      if (element.value) {
        formData.append(element.name, element.files[0]);
      }
    });

    // Send data to backend
    fetch(
      "http://localhost:81/task27_2/api/feedback/update/" + formData.get("id"),
      {
        method: "POST",
        body: formData,
      }
    ).then((res) => {
      if (res.ok) {
        //show all feedback
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
        fetch("http://localhost:81/task27_2/api/feedback/delete/" + id, {
          method: "POST",
        })
          .then((respon) => {
            $(this).parents("tr").fadeOut();
            Swal.fire("Deleted!", "", "success");
          })
          .catch((error) => {
            Swal.fire({
              icon: "error",
              name: "Oops... " + error,
              text: "Something went wrong!",
            });
          });
      }
    });
  });
});
