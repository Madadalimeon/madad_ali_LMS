<?php
include __DIR__ . "/../Model/Register_model.php";
if (isset($_GET["update_id"])) {
    $update_id = intval($_GET["update_id"]);
    $database = new Database();
    $conn = $database->getDB();
    $query = "SELECT * FROM users WHERE id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $update_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (isset($_POST["Update_name"])) {
        $Update_name = $_POST["Update_name"];
        $Update_email = $_POST["Update_email"];
        $Update_password = $_POST["Update_password"];
        $Update_role = $_POST["Update_role"];
        $update_Register = new Register_model();
        if ($update_Register->Update_Register($Update_name, $Update_email, $Update_password, $Update_role, $update_id)) {
            header("Location: http://localhost/madadali_LMS/View/tables.php");
            exit;
        } else {
            echo "Registration updata Failed!";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg p-4">
                    <h3 class="text-center mb-4">Register Update</h3>

                    <?php
                    if ($user) {
                    ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" value="<?php echo $user['name']  ?>" name="Update_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" value="<?php echo $user['email'] ?>" name="Update_email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <!-- <label class="form-label">Password</label> -->
                                <input type="hidden" value="<?php echo $user['password'] ?>" name="Update_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="Update_role" class="form-select" required>
                                    <option value="">Select Role</option>
                                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                    <option value="instructor" <?php if ($user['role'] == 'instructor') echo 'selected'; ?>>Instructor</option>
                                    <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Register</button>

                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>