<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}

include __DIR__ . "/../Config/Config.php";
include __DIR__ . "/../include/header.php";

$database = new Database();
$conn = $database->getDB();

$query = "SELECT 
            u.name AS instructor_name,
            c.id AS course_id,
            c.title,
            c.description,
            c.price AS course_price,
            en.enroll AS enroll_roll
          FROM courses c
          JOIN users u ON c.instructor_id = u.id
          LEFT JOIN enrollments en 
                ON en.course_id = c.id 
                AND en.student_id = ?
          WHERE c.status = 'Approve'";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION["student_id"]);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-4">
    <h3 class="mb-4">Shop the Courses</h3>
    <div class="row g-4">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">

                        <h5 class="card-title"><?= $row['title']; ?></h5>

                        <p><strong>Instructor: </strong><?= $row['instructor_name']; ?></p>

                        <p><strong>Price: </strong>
                            <?= ($row["course_price"] == 0) ? "Free" : "$ " . $row["course_price"]; ?>
                        </p>

                        <p class="card-text" style="height: 70px; overflow: hidden;">
                            <?= $row['description']; ?>
                        </p>

                        <?php if ($row["enroll_roll"] == "enroll"): ?>

                            <a href="View_Course.php?View_id=<?= $row['course_id']; ?>"
                                class="btn btn-info w-100 btn-sm mt-3">
                                View Course
                            </a>

                        <?php else: ?>

                            <form method="post" action="../Controller/Enroll_Controller.php">
                                <input type="hidden" name="course_id" value="<?= $row["course_id"]; ?>">
                                <input type="hidden" name="student_id" value="<?= $_SESSION["student_id"]; ?>">

                                <button type="submit" name="submit" class="btn btn-success w-100">
                                    Enroll
                                </button>
                            </form>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</div>

<?php include __DIR__ . "/../include/footer.php"; ?>

<?php
if(isset($_POST["course_id"])){
    header("Location: ../../email.php");
    exit;
}
?>


<?php if (isset($_GET["enroll_success"])): ?>
<script>
Swal.fire({
    title: 'Course Enrolled Successfully!',
    icon: 'success'
});
</script>
<?php endif; ?>

<?php if (isset($_GET["error"]) && $_GET["error"] === "already_enrolled"): ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'Already Enrolled',
    text: 'You are already enrolled in this course!'
});
</script>
<?php endif; ?>
