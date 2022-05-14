$(function () {
  if (document.getElementById("slider-data")) {
    fetch("http://localhost:81/task27_2/api/slider?limit=1000")
      .then((response) => response.json())
      .then((data) => {
        let items = "",
          i = 1;
        for (const item of data) {
          items +=
            /*html*/
            `
        <div class="carousel-item ${i == 1 ? "active" : ""}">
        <div class="container ">
          <div class="row">
            <div class="col-md-7 col-lg-6 ">
              <div class="detail-box">
                <h1>
                 ${item.title}
                </h1>
                <p>
                ${item.sub_title}
                </p>
                <div class="btn-box">
                  <a href="#food_section-id" class="btn1">
                    Order Now
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
        `;
          i++;
        }

        document.getElementById("slider-data").innerHTML = items;
      });
  }
});
