<?php
session_start();
include __DIR__ . "/../Config/Config.php";
include __DIR__ . "/../include/header.php";
?>

<style>
    .video-box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .playlist-box {
        background: #f7f7f7;
        padding: 20px;
        border-radius: 10px;
        height: 100%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }

    .playlist-item {
        padding: 12px;
        background: white;
        margin-bottom: 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
        border: 1px solid #ddd;
    }

    .playlist-item:hover {
        background: #ddd;
        transform: translateX(10 px);
    }

    .playlist-item.active {
        background: #dddddd98;
    }
</style>


<div class="container">
    <div class="row mt-4">
        <div class="col">
            <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 10%" id="progress-bar"></div>
            </div>
        </div>
    </div>

</div>
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-md-8">
            <?php
            if (isset($_GET['lesson_id'])) {
                $View_id = $_GET["View_id"] ?? null;
                $lesson_id = $_GET['lesson_id'] ?? null;
                $student_id = intval($_SESSION['student_id']);
                $database = new Database();
                $conn = $database->getDB();
                $query = "SELECT * from user_progress WHERE Action ='Complete' AND  lessons_id =  $lesson_id AND user_id = $student_id AND course_id = $View_id ";
                $stmt = mysqli_query($conn, $query);
                if ($stmt->num_rows < 1) {
            ?>
                    <form method="post">
                        <button type="submit" name="submit" value="1" class="btn btn-primary">Mark as Completed </button>
                    </form>
                <?php } else {
                ?>
                    <button type="submit" name="submit" value="1" class="btn btn-primary" disabled>Completed </button>
            <?php }
            }
            ?>
            <div class="video-box mt-3">
                <h4 class="mb-3">
                    Course Video
                </h4>
                <div style="position:relative; width:100%; padding-bottom:56.25%;">
                    <iframe id="video-player"
                        src=""
                        style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-5 pt-1">
            <div class="playlist-box">
                <?php
                if (isset($_POST['submit'])) {
                    $View_id =  intval($_GET["View_id"]);
                    $student_id = intval($_SESSION['student_id']);
                    $lesson_id = intval($_GET["lesson_id"]);
                    $database = new Database();
                    $conn = $database->getDB();
                    $check_query = "SELECT * FROM user_progress WHERE
                     user_id =$student_id
                     AND lessons_id = $lesson_id
                     AND course_id = $View_id LIMIT 1
                    ";
                    $check_stmt = mysqli_query($conn, $check_query);
                    if ($check_stmt->num_rows == 0) {
                        $userprogess_query = "INSERT INTO user_progress (user_id,lessons_id,course_id,Action) VALUES ($student_id,$lesson_id,$View_id,'Complete')";
                        $stmt = mysqli_query($conn, $userprogess_query);
                    }
                }
                ?>
                <h4 class="mb-3">Course Playlist</h4>
                <div class="playlist-item">
                    <?php
                    $course_id = intval($_GET['View_id']);
                    $lesson_id = intval($_GET['lesson_id'] ?? 0);
                    $student_id = intval($_SESSION['student_id']);
                    $database = new Database();
                    $conn = $database->getDB();
                    $query = "SELECT 
                    l.id AS lesson_id,
                    l.course_id,
                    l.video_url, 
                    l.title, 
                    up.Action 
                    FROM lessons l 
                    LEFT JOIN user_progress up 
                    ON l.id = up.lessons_id AND up.user_id = $student_id
                    WHERE l.course_id = $course_id
                    ORDER BY l.id ASC";
                    $stmt = mysqli_query($conn, $query);
                    while ($row = $stmt->fetch_assoc()) :                    
                    ?>
                        <a style="text-decoration:none; color:black;" href="View_Course.php?View_id=<?php echo $course_id ?>&lesson_id=<?php echo $row["lesson_id"] ?>">
                            <div class="playlist-item"
                                data-video="<?php echo $row['video_url']; ?>"
                                id="lesson-<?php echo $index; ?>">
                                <?php echo $row['title']; ?><?php
                                if ($row['Action'] == "Complete") {
                                echo " ✅";
                                }
                                ?>
                            </div>
                        </a>
                    <?php
                    endwhile;
                    ?>

                </div>
            </div>
        </div>

    </div>
</div>

<?php
$database = new Database();
$conn = $database->getDB();
$View_id = $_GET['View_id'];
$query = "SELECT COUNT(*) FROM user_progress WHERE Action = 'Complete' AND course_id = $View_id ";
$query_CASE = "SELECT CASE WHEN NOT EXISTS (SELECT 1 FROM user_progress WHERE NOT Action = 'Complete'
 AND course_id = $View_id )THEN 1 ELSE 0 END AS all_condition; ";
$stmt = mysqli_query($conn, $query_CASE);
$row = $stmt->fetch_assoc();
$value = intval($row['all_condition']);
?>

<?php if ($value == 1) { ?>
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col">
                <?php
                $database = new Database();
                $conn = $database->getDB();
                $query = "SELECT 
                    u.id,
                    u.name,
                    c.id,
                    c.title,
                    c.price
                    FROM users u
                    INNER JOIN courses c
                    ON u.id = c.instructor_id WHERE c.id = $View_id";
                $stmt = mysqli_query($conn, $query);
                $row = $stmt->fetch_assoc();
                ?>
                <a href="./Certificate.php?I_name=<?php echo $row['name'] ?>&C_title=<?php echo $row['title'] ?>&C_price=<?php echo $row['price'] ?> " class="btn btn-success">Generate Certificate</a>

            </div>
        </div>
    </div>
<?php } elseif ($value == 0) { ?>
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-secondary" disabled>Generate Certificate </button>
            </div>
        </div>
    <?php } ?>

    <script>
        const lessons = document.querySelectorAll('.playlist-item');
        const player = document.getElementById('video-player');
        if (lessons.length > 0) {
            const firstLesson = lessons[0];
            player.src = firstLesson.dataset.video;
            firstLesson.classList.add('active');
        }
        lessons.forEach(lesson => {
            lesson.addEventListener('click', () => {
                player.src = lesson.dataset.video;
                lessons.forEach(l => l.classList.remove('active'));
                lesson.classList.add('active');
            });
        });
    </script>
    <br><br><br><br>
    <?php
    include __DIR__ . "/../include/footer.php";
    ?>