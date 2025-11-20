<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include  __DIR__ . "/../include/header.php";
include __DIR__ . "/../Config/Config.php";


?>
<div class="container mt-4">
    <h3 class="mb-4">Your Courses</h3>
    <div class="row g-4">

        <?php
        $database = new Database();
        $conn = $database->getDB();
        $query = "SELECT * FROM courses ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $hash = false;
        while ($row = $result->fetch_assoc()):
            if ($row["status"] == "Pending") {
                $hash = true;
        ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text" style="height: 70px; overflow: hidden;">
                                <?php echo $row['description']; ?>
                            </p>
                            <a href="./../Controller/approve_reject.php?approve_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                Approve
                            </a>
                            <a href="./../Controller/approve_reject.php?reject_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
                                Reject
                            </a>

                        </div>
                    </div>
                </div>

        <?php
            }
        endwhile;
        if (!$hash) {
            echo '<h4 class="offset-5 text-muted center mt-5" >No Pending Courses</h4>';
        }
        ?>
    </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include  __DIR__ . "/../include/footer.php";
?>