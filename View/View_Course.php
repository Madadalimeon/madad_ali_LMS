<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: http://localhost/madadali_LMS/View/login.php");
    exit;
}
include  __DIR__ . "/../include/header.php";
include __DIR__ . "/../Config/Config.php";
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
</style>
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-md-8">
            <div class="video-box">
                <h4 class="mb-3">Course Video</h4>

                <div style="position:relative; width:100%; padding-bottom:56.25%;">
                    <iframe
                        src="https://www.youtube.com/embed/1IVopxj8q8U"
                        style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="playlist-box">
                <h4 class="mb-3">Course Playlist</h4>

                <div class="playlist-item">Lesson 1 – Introduction</div>
                <div class="playlist-item">Lesson 2 – Basic Concepts</div>
                <div class="playlist-item">Lesson 3 – Intermediate Topics</div>
                <div class="playlist-item">Lesson 4 – Advanced Techniques</div>
                <div class="playlist-item">Lesson 5 – Final Summary</div>

            </div>
        </div>

    </div>
</div>

<?php
include  __DIR__ . "/../include/footer.php";
?>