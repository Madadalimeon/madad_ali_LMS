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
    <h3 class="mb-4">Your Courses</h3>
    <div class="row g-4">

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        <p><strong>Instructor:</strong> <?php echo $row['instructor_name']; ?></p>

                        <p><strong>Price:</strong>
                            <?php echo ($row['course_price'] == 0) ? "Free" : "$ ".$row['course_price']; ?>
                        </p>

                        <p class="card-text" style="height: 70px; overflow: hidden;">
                            <?php echo $row['description']; ?>
                        </p>
                          
                        
                        <a href="enroll.php?enroll_id=<?php echo $row['course_id']; ?>" 
                           class="btn btn-primary w-100 btn-sm">Enroll Course</a>

                        <a href="View_Course.php?View_id=<?php echo $row['course_id']; ?>" 
                           class="btn btn-info w-100 btn-sm mt-3">View Course</a>
                    </div>

                </div>
            </div>
        <?php endwhile; ?>

    </div>
</div>

<?php include __DIR__ . "/../include/footer.php"; ?>
