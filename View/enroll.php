<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}

include __DIR__ . "/../Config/Config.php";
include __DIR__ . "/../include/header.php";

$enroll_id = intval($_GET['enroll_id']);

$database = new Database();
$conn = $database->getDB();

$query = "SELECT 
            u.name AS instructor_name,
            c.id AS course_id,
            c.title,
            c.description,
            c.price AS course_price
          FROM users u
          JOIN courses c ON c.instructor_id = u.id
          WHERE c.id = ? AND c.status = 'Approve'";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $enroll_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "<h3 class='text-center mt-5 text-danger'>Course not found!</h3>";
    exit;
}

if (isset($_GET["enroll_id"])) {
    echo "
        <script>
            Swal.fire({
                title: 'Course ready to enroll!',
                icon: 'success'
            });
        </script>
    ";
}
?>

<div class="container my-5">
    <h3 class="mb-4 text-center">Enroll in Course</h3>

    <div class="card shadow-lg border-0">
        <div class="row g-0">

            <div class="col-md-6 p-4">
                <h4 class="fw-bold text-primary"><?php echo $row['title']; ?></h4>
                <p class="text-muted"><?php echo substr($row['description'], 0, 200); ?>...</p>

                <p><strong>Price:</strong> 
                    <?php echo ($row['course_price'] == 0) ? "Free" : "$ " . $row['course_price']; ?>
                </p>

                <p class="small text-secondary">Instructor: <?php echo $row['instructor_name']; ?></p>
                <p class="small text-secondary">Buy Date: <?php echo date('Y-m-d'); ?></p>
            </div>

            <div class="col-md-6 p-4 border-start">
                <h5 class="mb-3">Confirm Enrollment</h5>

                <form method="post" action="./../Controller/Enroll_Controller.php">
                    <input type="hidden" name="course_id" value="<?php echo $row["course_id"]; ?>">
                    <input type="hidden" name="student_id" value="<?php echo $_SESSION["student_id"]; ?>">

                    <button type="submit" name="submit" class="btn btn-success w-100">Enroll</button>
                </form>

            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . "/../include/footer.php"; ?>
