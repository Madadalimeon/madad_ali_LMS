<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__ . "/../Config/Config.php";
include  __DIR__ . "/../include/header.php";
?>
<div class="container mt-4">
    <h3 class="mb-4">Your Courses</h3>
    <div class="row g-4">

        <?php
        $database = new Database();
        $conn = $database->getDB();
        $query = "SELECT 
                    u.id AS user_id,
                    u.name AS instructor_name,
                    u.email,
                    u.role,
                    c.id AS course_id,
                    c.title,
                    c.description,
                    c.instructor_id,
                    c.price AS course_price, 
                    c.status
                  FROM users u
                  JOIN courses c 
                    ON c.instructor_id = u.id
                  WHERE u.role = 'instructor'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $hash = false;
        while ($row = $result->fetch_assoc()):
            if ($row["status"] == "Approve") {
                $hash = true;
        ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p><strong>Instructor:</strong> <?php echo $row['instructor_name']; ?></p>
                            <p><strong>Course_price:</strong>$ <?php echo $row['course_price']; ?></p>
                            <p class="card-text" style="height: 70px; overflow: hidden;">
                                <?php echo $row['description']; ?>
                            </p>
                            <a href="?Buy_id=<?php echo $row['course_id']; ?>" class="btn btn-primary w-100 btn-sm">Buy Course</a>
                            <a href="./View_Course.php?View_id=<?php echo $row['course_id']; ?>" class="btn btn-info w-100 btn-sm mt-3">View course</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        endwhile;
        ?>
    </div>
</div>

<?php if (isset($_GET["Buy_id"])) { ?>
    <script>
        Swal.fire({
            title: "Courses is buy now",
            icon: "success"
        });
    </script>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
}
include  __DIR__ . "/../include/footer.php";
?>