<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include  __DIR__ . "/../include/header.php";
?>
<div class="container w-75">
    <div class="row">
        <div class="col">
            <h1>Course Add</h1>
             <form method="post" action="./../Controller/Course_Controller.php">
            <div class="mb-3">
                <label class="form-label">title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter course title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Enter course Description" required></textarea>
            </div>
            <div class="mb-3">
                <!-- <label class="form-label">instructor id</label> -->
                <input type="hidden" name="user_id" value="<?php echo  $_SESSION['user_id']; ?>" class="form-control" placeholder="Enter course instructor_id" required>
            </div>
            <div class="mb-3">
                <label class="form-label">price</label>
                <input type="number" name="price" class="form-control" placeholder="Enter course price" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">submit</button>
            </form>
        </div>
    </div>
</div>
<?php
include  __DIR__ . "/../include/footer.php";
?>