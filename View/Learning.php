<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__ . "/../Config/Config.php";
include __DIR__ . "/../include/header.php";
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3>My Learning</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Course_title</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">price</th>
                        <th scope="col">Active</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $database  = new Database();
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
                        <?php if ($row["enroll"] == "enroll") { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['instructor_id']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td>
                                    <a href="View_Course.php?View_id=<?= $row['course_id']; ?>"class="btn btn-info ">View Course</a>
                                    <a href="./../Controller/approve_reject.php?Not_Enroll_id=<?php echo $row['id']; ?>" class="btn btn-danger"> Unenroll this Course</a>
                                </td>
                            </tr>
                    <?php
                        };
                    endwhile;
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php
include __DIR__ . "/../include/footer.php";
?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'Not_enroll'):
?>
    <script>
        Swal.fire({
            title: "Course Not Enroll Successfully",
            icon: "success"
        });
    </script>
<?php
endif;
?>