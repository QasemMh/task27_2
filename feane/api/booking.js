$(function () {
  //check if user login first:
  if (document.getElementById("auth-btn")) {
    document.getElementById("auth-btn").addEventListener("click", () => {
      Swal.fire({
        title: "You'er Not Log In",
        showCancelButton: true,
        confirmButtonText: "Log in?",
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          location.href = "loginform.php";
        }
      });
    });
  }

  $(document).on("submit", "#booking-form", function (e) {
    e.preventDefault();
    let username = document.getElementById("submit-btn0").dataset.username;
    fetch("http://localhost:81/task27_2/api/users/userdata/" + username, {
      method: "POST",
    })
      .then((res) => res.json())
      .then((data) => {
        {
          submitForm(data.id ?? "0");
        }
      });
  });

  function submitForm(id) {
    const form = document.getElementById("booking-form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });
    form.querySelectorAll("select").forEach((element) => {
      formData[element.name] = element.value;
    });

    formData["user_id"] = id;

    // Send data to backend
    fetch("http://localhost:81/task27_2/api/booking/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        alert("Booking Was Submitted");
        document.querySelector("#booking-form").reset();
      } else {
        alert("Error. try again");
      }
    });
  }
});
