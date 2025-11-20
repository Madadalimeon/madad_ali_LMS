<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include  __DIR__ . "/../include/header.php";
include __DIR__ . "/../Config/Config.php";
$login_id = $_SESSION['user_id'];
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4 offset">
    <a href="Course_add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm offset-10"><i
            class="fas fa-user fa-sm text-white-50"></i>Course Add</a>
</div>
<div class="container mt-4">
    <h3 class="mb-4">Your Courses</h3>
    <div class="row g-4">

        <?php
        $database = new Database();
        $conn = $database->getDB();
        $query = "SELECT * FROM courses WHERE  instructor_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $login_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()):
            if ($row["status"] == "Approve") {

        ?>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text" style="height: 70px; overflow: hidden;"><?php echo $row['description']; ?></p>
                            <p class="card-text fw-bold text-success mb-2">
                                $. <?php echo $row['price']; ?>
                            </p>
                            <a href="playList.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View Playlist</a>
                            <a href="Course_lessons.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Add Lesson</a>
                            <a href="./../Controller/Course_Controller.php?Delete_id=<?php echo $row['id'] ?>" class="btn btn-danger text-white btn-sm">Delete</a>
                            <a href="Course_Update.php?update_id=<?php echo $row['id'] ?>" class="btn btn-primary text-white btn-sm mt-2">Update</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        endwhile; ?>
    </div>
</div>
<?php if (isset($_GET['Delete_id'])) { ?>
    <script>
        Swal.fire({
            title: "Courses Delete",
            icon: "success"
        });
    </script>
<?php
}
include  __DIR__ . "/../include/footer.php";
?>