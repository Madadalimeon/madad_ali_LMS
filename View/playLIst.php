<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__ . "/../Model/Course_model.php";

if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $_SESSION["playList"] =  $id;
}

$login_id = $_SESSION['user_id'];
$database = new Database();
$conn = $database->getDB();
$query = "SELECT * FROM lessons WHERE  course_id = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

include __DIR__ . "/../include/header.php";
?>
<div class="container mt-4">
    <h3 class="mb-4">Playlist of Lessons</h3>
    <a href="Course_lessons.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm mb-3 offset-10">Add Lesson</a>
    <div class="row g-4">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-sm mb-5" style="border-radius: 10px;">
                    <iframe width="100%" height="220"
                        src="<?php echo $row["video_url"]; ?>"
                        frameborder="0" allowfullscreen style="border-radius: 10px 10px 0 0;">
                    </iframe>

                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                        <p class="card-text text-muted">
                            <?php echo $row["content"]; ?>
                        </p>

                        <a href="Update_Lessons.php?lessons_Update_id=<?php echo $row['id'] ?>" class="btn btn-primary">Update</a>
                        <a href="?lessons_Delete_id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if (isset($_GET["lessons_Delete_id"])) {
    $Delete_id = intval($_GET["lessons_Delete_id"]);
    $lessons = new Course_model();

    if ($lessons->Deletelesson($Delete_id)) {
        ?>
        <script>
            Swal.fire({
                title: 'Good job!',
                text: 'Lesson Delete successfully!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'playLIst.php?id=<?= $_SESSION["playList"] ?>';
            });
        </script>
        <?php
    }
}

include __DIR__ . '/../include/footer.php';
?>