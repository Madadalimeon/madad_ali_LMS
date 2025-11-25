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
            u.id AS user_id,
            u.name AS instructor_name,
            c.id AS course_id,
            c.title,
            c.description,
            c.price AS course_price,
            c.status
          FROM users u
          JOIN courses c ON c.instructor_id = u.id
          WHERE c.status = 'Approve'";

$stmt = $conn->prepare($query);
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

                        <h5 class="card-title"><?php echo $row['title']; ?></h5>

                        <p><strong>Instructor:</strong> <?php echo $row['instructor_name']; ?></p>

                        <p><strong>Price:</strong>
                            <?php echo ($row['course_price'] == 0) ? "Free" : "$ " . $row['course_price']; ?>
                        </p>

                        <p class="card-text" style="height: 70px; overflow: hidden;">
                            <?php echo $row['description']; ?>
                        </p>

                        <?php 
                        if (isset($_GET["enroll_id"]) && $_GET["enroll_id"] === "success") { ?>                            
                            <a href="View_Course.php?View_id=<?php echo $row['course_id']; ?>"
                               class="btn btn-info w-100 btn-sm mt-3">
                               View Course
                            </a>
                        <?php } 
                        elseif (!isset($_GET["enroll_id"])) { ?>

                            <form method="post" action="./../Controller/Enroll_Controller.php">
                                <input type="hidden" name="course_id" value="<?php echo $row["course_id"]; ?>">
                                <input type="hidden" name="student_id" value="<?php echo $_SESSION["student_id"]; ?>">

                                <button type="submit" name="submit" class="btn btn-success w-100">
                                    Enroll
                                </button>
                            </form>

                        <?php } ?>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <?php if (isset($_GET["enroll_id"]) && $_GET["enroll_id"] === "success"): ?>
            <script>
                Swal.fire({
                    title: 'Course enrolled successfully!',
                    icon: 'success'
                });
            </script>
        <?php endif; ?>

    </div>
</div>

<?php include __DIR__ . "/../include/footer.php"; ?>
