<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
  header("Location: http://localhost/madadali_LMS/View/login.php");
  exit;
}
include __DIR__ . '/../config/config.php';
include __DIR__ . "/../include/header.php";
?>

<div class="container">
  <div class="row">
    <div class="col">
      <h4>Enroll table of student</h4>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Enrollment ID</th>
            <th scope="col">Course</th>
            <th scope="col">Student</th>
            <th scope="col">Email</th>
            <th scope="col">Enrolled At</th>
            <th scope="col">Enroll in Courser</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $database = new Database();
          $db = $database->getDB();
          $query = "SELECT 
          c.id AS course_id,
          c.title AS course_title,
          en.id AS enrollment_id,
          en.enrolled_at,
          u.id AS users_id,
          u.name AS users_name,
          u.email AS users_email
          FROM courses c
          JOIN enrollments en ON c.id = en.course_id
          JOIN users u ON en.student_id = u.id;";
          $stmt = $db->prepare($query);
          $stmt->execute();
          $result = $stmt->get_result();

          while ($row = $result->fetch_assoc()) :
          ?>
            <tr>
              <td><?php echo $row['enrollment_id']; ?></td>
              <td><?php echo $row['course_title']; ?></td>
              <td><?php echo $row['users_name']; ?></td>
              <td><?php echo $_SESSION["student_email"] =  $row['users_email']; ?></td>
              <td><?php echo $row['enrolled_at']; ?></td>
              <td><a href="./../Controller/approve_reject.php?Enroll_id=<?php echo $row['enrollment_id']; ?>" class="btn btn-success">Enroll Courser</a></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
include __DIR__ . "/../include/footer.php";
?>