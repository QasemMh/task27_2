documentReady(function () {
  let items = "";
  let totalPrice = 0;

  fetch("https://fakestoreapi.com/products?limit=2")
    .then((res) => res.json())
    .then((data) => {
      let i = 0;
      for (const item of data) {
        totalPrice += item.price;
        items += `
        <div
  class="row mb-4 d-flex justify-content-between align-items-center"
  >
  <div class="col-md-2 col-lg-2 col-xl-2">
    <img
      src="${item.image}"
      class="img-fluid rounded-3"
      alt="${item.title}"
    />
  </div>
  <div class="col-md-3 col-lg-3 col-xl-3">
    <h6 class="text-muted">${item.category}</h6>
    <h6 class="text-black mb-0">${item.title}</h6>
  </div>
  <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
    <button
      data-id="${item.id}"
      class="btn btn-link px-2 item-btn"
      onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
    >
      <i class="fas fa-minus"></i>
    </button>
  
    <input
      data-id="${item.id}"
      id="input-${item.id}"
      min="1"
      name="quantity"
      value="1"
      type="number"
      class="form-control form-control-sm"
    />
  
    <button
      data-id="${item.id}"
      class="btn btn-link px-2 item-btn"
      onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
    >
      <i class="fas fa-plus"></i>
    </button>
  </div>
  <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
    <h6 class="mb-0" >$ <span id="price-${item.id}">${item.price.toFixed(
          2
        )}</span></h6>
  </div>
  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
    <a href="#!" class="text-muted"
      ><i class="fas fa-times"></i
    ></a>
  </div>
  </div>
  <hr class="my-4" />
        
        `;
        i++;
      }

      document.getElementById("cart-items").innerHTML = items;
      document.getElementById("total-price").innerHTML = totalPrice.toFixed(2);
      document.getElementById("total-items").innerHTML = i;
    })
    .then(() => {
      const btns = document.querySelectorAll(".item-btn");
      btns.forEach((item) => {
        item.addEventListener("click", (e) => {
          setTotalPrice();
        });
      });

      const inputs = document.querySelectorAll("input[type='number']");
      inputs.forEach((item) => {
        item.addEventListener("keyup", (e) => {
          setTotalPrice();
          e.target.value = e.target.value || 1;
        });
      });

      //submit-btn
      let submitBtn = document.getElementById("submit-btn");
      submitBtn.addEventListener("click", (e) => {
        e.preventDefault();
        //
        const inputs = document.querySelectorAll("input[type='number']");
        const map = new Map();
        inputs.forEach((item) => {
          map.set(item.dataset.id, item.value);
        });
        //
        console.log(map);
        console.log(Object.fromEntries(map));
      });
    });

  //set total price
  function setTotalPrice() {
    let totalPriceElement = document.getElementById("total-price");
    let price = 0;
    const btns = document.querySelectorAll("input[type='number']");
    btns.forEach((item) => {
      let priceElement = document.getElementById("price-" + item.dataset.id);

      price += item.value * priceElement.textContent;
    });

    totalPriceElement.innerHTML = price.toFixed(2);
  }

  //end
});

// document ready
function documentReady(fn) {
  // see if DOM is already available
  if (
    document.readyState === "complete" ||
    document.readyState === "interactive"
  ) {
    // call on next available tick
    setTimeout(fn, 1);
  } else {
    document.addEventListener("DOMContentLoaded", fn);
  }
}
