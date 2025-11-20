x
<div class="container mt-4">
    <h3 class="mb-4">Your Courses</h3>
    <div class="row g-4">

        <?php
        $database = new Database();
        $conn = $database->getDB();
        $query = "SELECT * FROM courses";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $hash = false;
        while ($row = $result->fetch_assoc()):
            if ($row["status"] == "Approve") {
                $hash = true;
        ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text" style="height: 70px; overflow: hidden;">
                                <?php echo $row['description']; ?>
                            </p>
                            <a href="?Buy_id=<?php echo $row['id']; ?>" class="btn btn-primary w-100 btn-sm">
                                Buy Course
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            }
        endwhile;
        ?>
    </div>
</div>

<?php if (isset($_GET["Buy_id"])) { ?>
    <script>
        Swal.fire({
            title: "Courses is buy now",
            icon: "success"
        });
    </script>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
}
include  __DIR__ . "/../include/footer.php";
?>