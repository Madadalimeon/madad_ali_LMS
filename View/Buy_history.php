<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include  __DIR__ . "/../include/header.php";
include __DIR__ . "/../Config/Config.php";
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h3>History of buy Courser</h3>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Course title</th>
                        <th>Course price</th>
                        <th>Enrolled_at</th>
                    </tr>
                    <tr>
                        <?php
                        $database  = new Database();
                        $conn = $database->getDB();
                        $conn = $database->getDB();
                        $query = "SELECT 
                    enrollments.*,
                    courses.id AS course_id,
                    courses.title,
                    courses.description,
                    courses.price,
                    courses.instructor_id
                    FROM enrollments INNER
                    JOIN courses ON 
                    enrollments.course_id = courses.id 
                    WHERE enrollments.student_id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $_SESSION['student_id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) :
                        ?>
                            <td><?php echo $row['id']; ?></td>
                            <th><?php echo $row['title']; ?></th>
                            <th>$ <?php echo $row['price']; ?></th>
                            <td><?php echo $row['enrolled_at']; ?></td>
                    </tr>
                </thead>
            <?php
                        endwhile;
            ?>
            </table>
        </div>
    </div>
</div>

<?php
include  __DIR__ . "/../include/footer.php";

?>