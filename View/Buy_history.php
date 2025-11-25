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
                        <th>Course</th>
                        <th>Enrolled_at</th>
                    </tr>
                    <tr>
                        <?php
                        $database  = new Database();
                        $conn = $database->getDB();
                        $query = "SELECT * FROM enrollments WHERE student_id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $_SESSION['student_id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) :
                        ?>
                            <td><?php echo $row['id']; ?></td>
                            <th><?php echo $row['course_id']; ?></th>
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