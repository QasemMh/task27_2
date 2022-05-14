$(function () {
  fetch("http://localhost:81/task27_2/api/feedback?limit=1000")
    .then((response) => response.json())
    .then((data) => {
      let items = "",
        i = 1;
      for (const item of data) {
        items =
          /*html*/
          `
            <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
${item.content}               </p>
                <h6>
                ${item.name} 
                </h6>
                <p>
                 </p>
              </div>
              <div class="img-box">
                <img src="http://localhost:81/task27_2/image/${item.path}" alt="" class="box-img">
              </div>
            </div>
          </div>
  
          `;
        i++;
        $(".owl-carousel").trigger("add.owl.carousel", items);
      }

      //  document.getElementById("feedback-data").innerHTML = items;
    });
});
