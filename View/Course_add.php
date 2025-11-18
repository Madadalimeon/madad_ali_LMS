<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include  __DIR__ . "/../include/header.php";
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Course Add</h1>
            <div class="mb-3">
                <label class="form-label">title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">description</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">instructor_id</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">price</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>
    </div>
</div>


<?php
include  __DIR__ . "/../include/footer.php";
?>