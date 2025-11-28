<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include __DIR__ . "/../Config/Config.php";
include __DIR__ . "/../include/header.php";
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3>My Learning</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Course_title</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">price</th>
                        <th scope="col">Active</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include __DIR__ . "/../include/footer.php";
?>