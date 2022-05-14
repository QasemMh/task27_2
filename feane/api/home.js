$(function () {
  fetch("http://localhost:81/task27_2/api/home?limit=1000")
    .then((response) => response.json())
    .then((data) => {
      document.title = data.tap_title;
      if (document.getElementById("logo-name"))
        document.getElementById("logo-name").innerHTML = data.logo_name;
      document.getElementById("footer-about").innerHTML = data.about;
      document.getElementById("footer-logo").innerHTML = data.logo_name;
      document.getElementById("email-data").innerHTML = data.email;
      document.getElementById("phone-data").innerHTML = data.phone;
      document.getElementById("openhour-data").innerHTML = data.open_hour;
    });
});
