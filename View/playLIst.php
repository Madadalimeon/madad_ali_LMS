<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__ . "/../Model/Course_model.php";
$login_id = $_SESSION['user_id'];
$database = new Database();
$conn = $database->getDB();
$query = "SELECT * FROM lessons WHERE  id = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $login_id);
$stmt->execute();
$result = $stmt->get_result();

include __DIR__ . "/../include/header.php";
?>
<div class="container mt-4">
    <h3 class="mb-4">Playlist of Lessons</h3>
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
                        <button class="btn btn-danger delete-btn" data-id="<?php echo $row['id'] ?>">Delete</button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const lessonId = this.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?Delete_id=" + lessonId;
                }
            });
        });
    });
</script>

<?php

if (isset($_GET["Delete_id"])) {
    $Delete_id = intval($_GET["Delete_id"]);
    $lessons = new Course_model();
    if ($lessons->Deletelesson($Delete_id)) {
        echo "<script>
            Swal.fire({
                title: 'Deleted!',
                text: 'Lesson has been deleted.',
                icon: 'success'
            }).then(() => {
                window.location.href='playList.php';
            });
        </script>";
    }
}
include __DIR__ . "/../include/footer.php";
?>