        <?php
        session_start();
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "instructor") {
            header("Location: http://localhost/madadali_LMS/View/login.php");
            exit;
        }
        include __DIR__ . "/../Model/Course_model.php";
        if (isset($_GET["id"])) {
            $id = intval($_GET['id']);
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $course_id = intval($_POST["course_id"]);
            $title = $_POST["title"];
            $content = $_POST["content"];
            $video_url = $_POST["video_url"];
            $lessons = new  Course_model();
            if ($lessons->Addlesson($course_id, $title, $content, $video_url)) {
            }
        }
        include  __DIR__ . "/../include/header.php";

        ?>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="mb-3">Add Lesson</h3>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="hidden" name="course_id" value="<?php echo $id; ?>" class="form-control" placeholder="Enter Course ID" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lesson Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Lesson Title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control" rows="4" placeholder="Enter Lesson Content" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Video URL</label>
                            <input type="text" name="video_url" class="form-control" placeholder="Enter Video URL or Upload Below">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Lesson</button>
                    </form>
                </div>
            </div>
        </div>
        <?php if (isset($_POST['title']) == "submit" ) { ?>
            <script>
                Swal.fire({
                    title: "Good job!",
                    text: "Add lessons successfull",
                    icon: "success"
                });
            </script>

        <?php
        }
        include  __DIR__ . "/../include/footer.php";
        ?>