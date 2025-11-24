<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include  __DIR__ . "/../include/header.php";
include __DIR__ . "/../Config/Config.php";
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="offset-4">History of buy Courser</h3>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th>id</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php
include  __DIR__ . "/../include/footer.php";

?>