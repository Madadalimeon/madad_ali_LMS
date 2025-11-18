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
    <div class="d-sm-flex align-items-center justify-content-between mb-4 offset">
        <a href="register.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm offset-10"><i
                class="fas fa-user fa-sm text-white-50"></i>Register_User</a>
    </div>
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
                        $query = "SELECT * FROM users";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) :
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td>
                                    <a href="./../Model/Delete.php?Delete_id=<?php echo $row['id'] ?>" class="btn btn-danger text-white">Delete</a>
                                    <a href="Update_register.php?update_id=<?php echo $row['id'] ?>" class="btn btn-primary text-white">Update</a>
                                </td>

                            <?php
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