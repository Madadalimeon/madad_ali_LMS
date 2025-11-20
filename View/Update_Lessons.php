<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__ . "/../Model/Course_model.php";

$update_success = false;

if (isset($_GET["lessons_Update_id"])) {
    $lessons_Update_id = intval($_GET['lessons_Update_id']);
    $database = new Database();
    $conn = $database->getDB();
    $query = "SELECT * FROM lessons WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $lessons_Update_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Lesson_title = $_POST['Lesson_title'];
        $Lesson_content = $_POST['Lesson_content'];
        $Lesson_video_url = $_POST['Lesson_video_url'];
        $lessons_Update = new Course_model();
        if ($lessons_Update->updatelesson($Lesson_title, $Lesson_content, $Lesson_video_url, $lessons_Update_id)) {
            $update_success = true; 
        }
    }
}

include __DIR__ . "/../include/header.php";
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="mb-3">Update Lesson</h3>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Lesson Title</label>
                    <input type="text" name="Lesson_title" value="<?php echo $user['title'] ?>" class="form-control" placeholder="Enter Lesson Title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="Lesson_content" class="form-control" rows="4" placeholder="Enter Lesson Content" required><?php echo $user['content'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Video URL</label>
                    <input type="text" value="<?php echo $user['video_url'] ?>" name="Lesson_video_url" class="form-control" placeholder="Enter Video URL">
                </div>
                <button type="submit" class="btn btn-primary w-100">Save Lesson</button>
            </form>
        </div>
    </div>
</div>

<?php if ($update_success) : ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: "Good job!",
        text: "Lesson updated successfully!",
        icon: "success"
    }).then(() => {
        window.location.href = "MYCourse.php";
    });
</script>
<?php endif; ?>

<?php
include __DIR__ . "/../include/footer.php";
?>
