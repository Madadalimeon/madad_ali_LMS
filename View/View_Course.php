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
        transform: translateX(15px);
    }

    .playlist-item.active {
        background: #dddddd98;
    }
</style>


<div class="container">
    <div class="row mt-4">
        <div class="col">
            <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%" id="progress-bar"></div>
            </div>
        </div>
    </div>

</div>
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-md-8">
            <?php
            $lesson_id = $_GET['lesson_id'];
            $database = new Database();
            $conn = $database->getDB();
            $query = "SELECT * from lessons WHERE Active ='Not_Complete' AND  id =  $lesson_id ";
            $stmt = mysqli_query($conn, $query);
            if ($stmt->num_rows > 0) {
            ?>
                <form method="post">
                    <button type="submit" name="submit" value="1" class="btn btn-primary">Mark as Completed </button>
                </form>
            <?php } else {  ?>
                <button type="submit" name="submit" value="1" class="btn btn-primary" disabled>Completed </button>
            <?php } ?>
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
                if (isset($_POST['submit']) == "submit") {
                    $course_id =  $_GET['View_id'];
                    $lesson_id = $_GET['lesson_id'];
                    $Check_value = intval($_POST['submit']);
                    $database = new Database();
                    $conn = $database->getDB();
                    $query = "UPDATE lessons SET Active = 'Complete' WHERE id = $lesson_id";
                    $stmt = mysqli_query($conn, $query);
                }



                ?>
                <h4 class="mb-3">Course Playlist</h4>
                <div class="playlist-item">
                    <?php
                    $course_id =  $_GET['View_id'];
                    $lesson_id =  $_GET['lesson_id'] ?? null;
                    $database = new Database();
                    $conn = $database->getDB();
                    $query = "SELECT * FROM lessons WHERE course_id = $course_id";
                    $stmt = mysqli_query($conn, $query);
                    while ($row = $stmt->fetch_assoc()) :
                    ?>
                        <a href="View_Course.php?View_id=<?php echo $course_id ?>&lesson_id=<?php echo $row["id"]  ?>">

                            <div class="playlist-item" data-video="<?php echo $row['video_url']; ?>" id="lesson-<?php echo $index; ?>">
                                <?php echo $row['title']; ?>
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
$query = "SELECT COUNT(*) FROM lessons WHERE Active = 'Complete' AND course_id = $View_id ";

?>
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success">Generate Certificate </button>
        </div>
    </div>
</div>

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

<?php
include __DIR__ . "/../include/footer.php";
?>