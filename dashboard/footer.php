</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Clever Mind POB ICT</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
<!-- End of Content Wrapper -->
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<!-- End of Page Wrapper -->
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- sweetalert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- app -->
<script src="app.js"></script>


<!-- users -->
<?php if (!empty(setActive("users"))) {
    echo '<script src="api/users.js"></script>';
} ?>


<!-- User Message -->
<?php if (!empty(setActive("booking"))) {
    echo '<script src="api/booking.js"></script>';
} ?>



<!-- slider -->
<?php if (!empty(setActive("slider"))) {
    echo '<script src="api/slider.js"></script>';
} ?>

<!-- special-section -->
<?php if (!empty(setActive("special-section"))) {
    echo '<script src="api/special-section.js"></script>';
} ?>
<!--feedback -->
<?php if (!empty(setActive("feedback"))) {
    echo '<script src="api/feedback.js"></script>';
} ?>


<!-- Home -->
<?php if (!empty(setActive("Home"))) {
    echo '<script src="api/home.js"></script>';
} ?>
<!-- Contact -->
<?php if (!empty(setActive("Contact"))) {
    echo '<script src="api/contact.js"></script>';
} ?>
<!-- about -->
<?php if (!empty(setActive("about"))) {
    echo '<script src="api/about-us.js"></script>';
} ?>
<?php if (!empty(setActive("menu"))) {
    echo '<script src="api/menu.js"></script>';
} ?>












<!-- Custom scripts for all pages-->
<!--  data-table -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!--data-table -->
<script src="js/demo/datatables-demo.js"></script>
<!-- all -->
<script src="js/sb-admin-2.min.js"></script>


<script>
    $(document).on("submit", "#search_form", function(e) {
        e.preventDefault();
        let form = document.getElementById("search_form");
        let formData = {};
        form.querySelectorAll("input").forEach((element) => {
            formData[element.name] = element.value;
        });

        let searchTerm = formData["searchTerm"].toLowerCase();


        switch (searchTerm) {
            case "users":
                location.href = "users.php";
                break; // item
            case "home":
                location.href = "home.php";
                break; // item
            case "contact":
                location.href = "contact.php";
                break; // item
            case "index":
                location.href = "index.php";
                break; // item
            case "about us":
                location.href = "about-us.php";
                break;


            default:
                location.href = "index.php?err=Search Term Not Found Try Again.";
        }
    });
</script>

<script defer>
    let url = new URL(location.href);
    let params = new URLSearchParams(url.search);

    let msg = `  <div class="alert alert-danger w-50" role="alert">`;
    msg += `<i class="fas fa-exclamation-circle "></i> Your Search not found, try again`;
    msg += "</div>";
    if (params.get("err"))
        $("#serachMsg").html(msg);
</script>





</body>

</html>