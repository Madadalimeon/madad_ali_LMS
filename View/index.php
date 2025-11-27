<?php
session_start();
if (!isset($_SESSION["role"]) && $_SESSION["role"] !== "admin") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
} elseif (!isset($_SESSION["role"]) && $_SESSION["role"] !== "instructor") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
} elseif (!isset($_SESSION["role"]) && $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__ . "/../Config/Config.php";
include __DIR__ . "/../include/header.php";
?>

<?php if (isset($_SESSION['role'])  && $_SESSION["role"] == "admin") : ?>

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total instructor</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $database = new Database();
                                    $conn = $database->getDB();
                                    $query = "SELECT COUNT(*) AS total FROM users WHERE role = 'instructor'";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total student</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $database = new Database();
                                    $conn = $database->getDB();
                                    $query = "SELECT COUNT(*) AS total FROM users WHERE role = 'student'";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas  fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total user </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $database = new Database();
                                    $conn = $database->getDB();
                                    $query = "SELECT COUNT(*) AS total FROM users WHERE  NOT role = 'admin'";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total active coures </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $database = new Database();
                                    $conn = $database->getDB();
                                    $query = "SELECT COUNT(*) AS total FROM courses WHERE  status = 'Approve'";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total pending </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $database = new Database();
                                $conn = $database->getDB();
                                $query = "SELECT COUNT(*) AS total FROM courses WHERE  status = 'pending'";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--   container -->
<?php endif; ?>
<?php if (isset($_SESSION['role'])  && $_SESSION["role"] == "instructor") : ?>
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total enroll student </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $database = new Database();
                                    $conn = $database->getDB();
                                    $query = "SELECT COUNT(*) AS total FROM enrollments WHERE enroll = 'enroll'";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['total'];
                                    ?>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php endif; ?>

</div>
<?php
include __DIR__ . "/../include/footer.php";
?>