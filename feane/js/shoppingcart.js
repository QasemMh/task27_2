documentReady(function () {
  let items = `<div class="title">Shopping Bag</div>`;
  let totalPrice = 0;

  //get all data from local storage
  let keys = Object.keys(localStorage)
    .filter((key) => /^\d+$/.test(+key))
    .join(",");

  keysObj = { ids: keys };

  fetch("http://localhost:81/task27_2/api/menu/where", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(keysObj),
  })
    .then((res) => res.json())
    .then((data) => {
      let i = 0;
      for (const item of data) {
        totalPrice += parseFloat(item.price);
        items += `
        
        <!-- Product #${i} -->
        <div class="item">
          <div class="buttons">
            <span class="delete-btn" id="delete-${item.id}">
              <i class="far fa-trash-alt" data-id="${item.id}"></i>
            </span>
          </div>

          <div class="image">
            <img
              src="http://localhost:81/task27_2/image/${item.path}"
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
      //plus button
      const plusBtn = document.querySelectorAll(".plus-btn");
      plusBtn.forEach((item) => {
        item.addEventListener("click", (e) => {
          document.getElementById("input-" + item.dataset.id).stepUp();
          setTotalPrice();
        });
      });
      //minus button
      const minusBtn = document.querySelectorAll(".minus-btn");
      minusBtn.forEach((item) => {
        item.addEventListener("click", (e) => {
          document.getElementById("input-" + item.dataset.id).stepDown();
          setTotalPrice();
        });
      });

      //handel plus/minus value from input
      const inputs = document.querySelectorAll("input[type='number']");
      inputs.forEach((item) => {
        item.addEventListener("keyup", (e) => {
          setTotalPrice();
          e.target.value = e.target.value || 1;
        });
      });

      //handel delete btn
      let deleteBtns = document.querySelectorAll(".delete-btn i");
      deleteBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
          Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
          }).then((result) => {
            if (result.isConfirmed) {
              if (deleteItem(btn.dataset.id)) {
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                btn.parentNode.parentNode.parentNode.remove();
                setTotalPrice();
              }
            }
          });
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

        localStorage.clear();
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

  //handel delete btn
  function deleteItem(id) {
    if (localStorage.getItem(id + "")) {
      localStorage.removeItem(id + "");
      return true;
    }
    return false;
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
