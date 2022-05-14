documentReady(function () {
  let items = `<div class="title">Shopping Bag</div>`;
  let totalPrice = 0;

  fetch("https://fakestoreapi.com/products?limit=3")
    .then((res) => res.json())
    .then((data) => {
      let i = 0;
      for (const item of data) {
        totalPrice += item.price;
        items += `
        
        <!-- Product #${i} -->
        <div class="item">
          <div class="buttons">
            <span class="delete-btn" id="delete-${item.id}">
              <i class="far fa-trash-alt"></i>
            </span>
          </div>

          <div class="image">
            <img
              src="${item.image}"
              alt="item photo"
            />
          </div>

          <div class="description">
            <span>${item.title}</span>
            <span>${item.category}</span>
          </div>

          <div class="quantity">
            <button
             class="plus-btn item-btn"
              id="plus-${item.id}"
                type="button" 
                data-id="${item.id}"
                >
              <i class="fas fa-plus"></i>
            </button>
            <input type="number" 
            data-id="${item.id}"
            name="quantity" value="1" min="1" id="input-${item.id}" />
            <button class="minus-btn item-btn" id="minus-${item.id}" type="button" data-id="${item.id}">
              <i class="fas fa-minus"></i>
            </button>
          </div>

          <div class="total-price" id="price-${item.id}">${item.price}</div>
        </div>
        <!-- Product #${i} -->
          
        
        `;
        i++;
      }

      document.getElementById("shopping-cart").innerHTML = items;
      document.getElementById("total-price").innerHTML = totalPrice.toFixed(2);
      document.getElementById("total-items").innerHTML = i;
    })
    .then(() => {
      const plusBtn = document.querySelectorAll(".plus-btn");
      plusBtn.forEach((item) => {
        item.addEventListener("click", (e) => {
          document.getElementById("input-" + item.dataset.id).stepUp();
          setTotalPrice();
        });
      });
      const minusBtn = document.querySelectorAll(".minus-btn");
      minusBtn.forEach((item) => {
        item.addEventListener("click", (e) => {
          document.getElementById("input-" + item.dataset.id).stepDown();
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
