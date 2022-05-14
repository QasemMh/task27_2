const main = document.getElementById("main-container");
const toggleBtn = document.querySelectorAll(".toggle");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

if (bullets && main && toggleBtn && images) {
  //
  toggleBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      main.classList.toggle("sign-up-mode");
    });
  });
  //
  bullets.forEach((item) => {
    item.addEventListener("click", () => {
      moveSlider(item.dataset.value);
      item.classList.add("active");
    });
  });

  function moveSlider(index) {
    //image
    let currentImage = document.querySelector(".img-" + index);
    images.forEach((img) => {
      img.classList.remove("show");
    });
    currentImage.classList.add("show");

    //text
    let textSlider = document.querySelector(".text-group");
    textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

    //bullets
    bullets.forEach((item) => {
      item.classList.remove("active");
    });
  }

  // auto slider
  let i = 1;
  const autoSlider = setInterval(() => {
    let item1 = bullets[0];
    let item2 = bullets[1];
    let item3 = bullets[2];
    if (i == 1) {
      moveSlider(item1.dataset.value);
      item1.classList.add("active");
    } else if (i == 2) {
      moveSlider(item2.dataset.value);
      item2.classList.add("active");
    } else if (i == 3) {
      moveSlider(item3.dataset.value);
      item3.classList.add("active");
    } else {
      i = 0;
    }
    i++;
  }, 5000);
}
