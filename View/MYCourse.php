<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include  __DIR__ . "/../include/header.php";
include __DIR__ . "/../Config/Config.php";
$login_id = $_SESSION['user_id'];
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4 offset">
    <a href="Course_add.php" class="btn btn-primary btn-sm shadow-sm offset-10">
        <i class="fas fa-user fa-sm text-white-50"></i> Course Add
    </a>
</div>

<div class="container mt-4">
    <h3 class="mb-4">Your Courses</h3>

    <table class="table table-bordered table-striped table-hover">
        <thead class="">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $database = new Database();
            $conn = $database->getDB();
            $query = "SELECT * FROM courses WHERE instructor_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $login_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $i = 1;

            while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['title']; ?></td>

                    <td class="<?php echo ($row['status'] == 'Approve') ? 'text-success fw-bold' : 'text-info fw-bold'; ?>">
                        <?php echo $row['status']; ?>
                    </td>

                    <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <?php echo $row['description']; ?>
                    </td>

                    <td class="text-success fw-bold">
                        $. <?php echo $row['price']; ?>
                    </td>

                    <td>
                        <?php if ($row["status"] == "Approve"): ?>
                            <a href="playList.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mb-1">View Playlist</a>
                            <a href="Course_lessons.php?id=<?php echo $_SESSION['id'] = $row['id']; ?>" class="btn btn-success btn-sm mb-1">Add Lesson</a>
                            <a href="./../Controller/Course_Controller.php?Delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mb-1">Delete</a>
                            <a href="Course_Update.php?update_id=<?php echo $row['id']; ?>" class="btn btn-info text-white btn-sm mb-1">Update</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php if (isset($_GET['add']) && $_GET['add'] == 'success'): ?>
    <script>
        Swal.fire({
            title: "Course Added!",
            icon: "success",
            text: "Your course has been added successfully!"
        });
    </script>
<?php endif; ?>

<?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
    <script>
        Swal.fire({
            title: "Good job!",
            text: "Your course is updated now!",
            icon: "success"
        });
    </script>
<?php endif; ?>

<?php if (isset($_GET['Delete_id'])): ?>
    <script>
        Swal.fire({
            title: "Course Deleted",
            icon: "success"
        });
    </script>
<?php endif; ?>

<?php include  __DIR__ . "/../include/footer.php"; ?>