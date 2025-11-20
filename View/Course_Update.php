<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
 include  __DIR__ . "/../include/header.php";
 include __DIR__ ."/../Config/Config.php";
if (isset($_GET["update_id"])) {
    $update_id = intval($_GET['update_id']);
    $database = new Database();
    $conn = $database->getDB();
    $query = "SELECT * FROM courses WHERE id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $update_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

?>

<div class="container w-75">
    <div class="row">
        <div class="col">
            <h1>Course Update</h1>

            <?php
            if ($user) {
            ?>

                <form method="post" action="./../Controller/Course_Controller.php">
                    <input type="hidden" name="update_id" value="<?php echo $user['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label">title</label>
                        <input type="text" value="<?php echo $user['title'] ?>" name="Update_title" class="form-control" placeholder="Enter course title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="Update_description" class="form-control" rows="3" placeholder="Enter course Description" required><?php echo $user['description']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">price</label>
                        <input type="number" name="Update_price" value="<?php echo $user['price'] ?>" class="form-control" placeholder="Enter course price" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Course Update</button>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>


<?php
include  __DIR__ . "/../include/footer.php";
?>