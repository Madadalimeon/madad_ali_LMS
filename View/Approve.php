<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__ . "/../Config/Config.php";
include  __DIR__ . "/../include/header.php";
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables Register_User </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $database  = new Database();
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
                    c.price,
                    c.status
                  FROM users u
                  JOIN courses c 
                    ON c.instructor_id = u.id
                  WHERE u.role = 'instructor'";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) :
                              if ($row["status"] == "Pending"):
                        ?>
                            <tr>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['instructor_name']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td>
                                    <a href="./../Controller/approve_reject.php?approve_id=<?php echo $row['course_id']; ?>" class="btn btn-primary btn-sm">Approve</a>
                                    <a href="./../Controller/approve_reject.php?reject_id=<?php echo $row['course_id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                                </td>

                            <?php
                            endif;
                        endwhile;
                            ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
include  __DIR__ . "/../include/footer.php";
?>