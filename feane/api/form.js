$(function () {
  //login
  $(document).on("submit", "#sign-in-form", function (e) {
    e.preventDefault();
    const form = document.getElementById("sign-in-form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch(
      "http://localhost:81/task27_2/api/users/auth/" +
        formData["username"] +
        "-" +
        formData["password"],
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      }
    ).then((res) => {
      if (res.ok) {
        location.href = "index.php";
      } else {
        alert("Invalid data try again");
      }
    });
  });

  //sign up
  $(document).on("submit", "#sign-up-form", function (e) {
    e.preventDefault();
    const form = document.getElementById("sign-up-form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch("http://localhost:81/task27_2/api/users/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        location.href = "index.php";
      } else {
        alert("Error, try again");
      }
    });
  });
});
